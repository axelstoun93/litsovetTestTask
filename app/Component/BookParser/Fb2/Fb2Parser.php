<?php

namespace App\Component\BookParser\Fb2;

use App\Component\BookParser\Data\BookParserInterface;
use App\Component\BookParser\Entity\AuthorFactory;
use App\Component\BookParser\Entity\ChapterFactory;
use App\Component\BookParser\Entity\GenreFactory;
use App\Component\BookParser\Entity\NoticeFactory;
use App\Component\BookParser\Entity\TranslatorFactory;


/**
 * Class Fb2Parser
 */

class Fb2Parser implements BookParserInterface
{

    /**
     * @var \SimpleXMLElement
     */
    public \SimpleXMLElement $file;

    /**
     * @var ChapterFactory
     */
    private ChapterFactory $chapterFactory;

    /**
     * @var AuthorFactory
     */
    private AuthorFactory $authorFactory;

    /**
     * @var TranslatorFactory
     */
    private TranslatorFactory $translatorFactory;

    /**
     * @var GenreFactory
     */
    private GenreFactory $genreFactory;

    /**
     * @var NoticeFactory
     */
    private NoticeFactory $noticeFactory;

    /**
     * Fb2Parser constructor.
     * @param string $xmlFile
     */
    public function __construct(string $xmlFile)
    {
        $this->file = $this->readFb2($xmlFile);
        $this->chapterFactory = new ChapterFactory();
        $this->authorFactory = new AuthorFactory();
        $this->translatorFactory = new TranslatorFactory();
        $this->genreFactory = new GenreFactory();
        $this->noticeFactory = new NoticeFactory();
    }


    /**
     * @return array
     */
    public function getAuthors(): array
    {
        $result = [];

        if (!empty($this->file->description->{'title-info'}->author)) {
            foreach ($this->file->description->{'title-info'}->author as $key => $value) {
                $firstName = (string)$value->{'first-name'};
                $lastName = (string)$value->{'last-name'};
                $middleName = (string)$value->{'middle-name'};
                $nickname = (string)$value->{'nickname'};
                $email = (string)$value->{'email'};

                $result[] = $this->authorFactory->create(
                    [
                        'middleName' => $middleName,
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'email' => $email,
                        'nickname' => $nickname
                    ]
                );
            }
        }

        return $result;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        if (!empty($this->file->description->{'title-info'}->{'book-title'})) {
            return (string)$this->file->description->{'title-info'}->{'book-title'};
        }
        return '';
    }


    /**
     * @return array
     */
    public function getChapters(): array
    {
        $chapters = [];

        foreach ($this->file->body->section as $v) {

            if(empty($v->title) and count($this->file->body->section) > 1){
                continue;
            }



            if (empty($v->title) and count($this->file->body->section) == 1) {
                $title = 'Нет главы';
            }else{
                if(count($v->title->p) > 1){
                    $title = strip_tags(implode(' ',(array)$v->title->p));
                }else{
                    $title = strip_tags($v->title->p->asXML());
                }
            }

            $content = strip_tags($v->asXML());
            $content = str_replace($title, "",  $content);

            $chapter = $this->chapterFactory->create(
                [
                    'title' => strip_tags($title),
                    'content' => strip_tags($content)
                ]
            );

            $chapters[] = $chapter;
        }


        return $chapters;
    }


    /**
     * @return array
     */
    public function getTranslators(): array
    {
        $result = [];

        if (!empty($this->file->description->{'title-info'}->translator)) {
            foreach ($this->file->description->{'title-info'}->translator as $translator) {
                $firstName = (string)$translator->{'first-name'};
                $lastName = (string)$translator->{'last-name'};
                $middleName = (string)$translator->{'middle-name'};
                $nickname = (string)$translator->{'nickname'};
                $email = (string)$translator->{'email'};

                $result[] = $this->translatorFactory->create(
                    [
                        'middleName' => $middleName,
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'email' => $email,
                        'nickname' => $nickname
                    ]
                );
            }
        }

        return $result;
    }


    /**
     * @return string
     */
    public function getAnnotation(): string
    {
        $annotation = '';

        if (!empty($this->file->description->{'title-info'}->annotation)) {
            $annotation = $this->file->description->{'title-info'}->annotation->asXML();
        }

        return trim(strip_tags($annotation));
    }

    /**
     * @return array
     */
    public function getGenres(): array
    {
        $genres = [];

        if (!empty($this->file->description->{'title-info'}->genre)) {
            foreach ($this->file->description->{'title-info'}->genre as $genre) {
                $genres[] = $this->genreFactory->create(['name' => (string)$genre]);
            }
        }


        return $genres;
    }


    /**
     * @return array
     */
    public function getNotice(): array
    {
        $notice = [];

        if (!empty($this->file->body[1]) &&
            (string)$this->file->body[1]->attributes()->name === 'notes') {
            foreach ($this->file->body[1]->section as $section) {
                $description = $section->p;

                if ($section->p->count() > 1) {
                    $description = implode(PHP_EOL, (array)$section->p);
                }

                $notice[] = $this->noticeFactory->create(
                    [
                        'number' => (integer)$section->title->p,
                        'description' => (string)$description
                    ]
                );
            }
        }

        return $notice;
    }


    /**
     * @param $xmlFile
     * @return \SimpleXMLElement
     */
    private function readFb2($xmlFile): \SimpleXMLElement
    {
        $string = file_get_contents($xmlFile);
        return simplexml_load_string($string);
    }


}

