<?php

namespace App\Component\BookParser\Docx;

use App\Component\BookParser\Data\BookParserInterface;
use App\Component\BookParser\Entity\AuthorFactory;
use App\Component\BookParser\Entity\ChapterFactory;
use App\Component\BookParser\Entity\GenreFactory;
use App\Component\BookParser\Entity\NoticeFactory;
use App\Component\BookParser\Entity\TranslatorFactory;
use DOMDocument;
use ZipArchive;

use function PHPUnit\Framework\throwException;

class DocxParser implements BookParserInterface
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

    private string $title;

    public function __construct(string $docxFile)
    {
        $this->file = $this->readDocx($docxFile);
        $this->chapterFactory = new ChapterFactory();
    }

    public function getAuthors()
    {
        return '';
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = str_replace(".docx", "", $title);
    }

    public function getChapters()
    {
        $chaptersDocx = $this->file->xpath('//w:hyperlink/w:r[1]/w:t');
        $chapters = [];

        if (!empty($chaptersDocx)) {
            $docxText = $this->xmlConvertText();

            foreach ($chaptersDocx as $key => $chapter) {
                $currentChapterPosition = stripos($docxText, (string)$chapter);
                $chapterTitle = (string)$chapter;

                if (array_key_last($chaptersDocx) == $key) {
                    $readyChapterContent = substr($docxText, $currentChapterPosition);
                } else {
                    $nextKey = ++$key;

                    $nextChapter = stripos($docxText, (string)$chaptersDocx[$nextKey]);
                    $lengthChapter = $nextChapter - $currentChapterPosition;
                    $readyChapterContent = substr($docxText, $currentChapterPosition, $lengthChapter);
                }

                $chapters[] = $this->chapterFactory->create(
                    [
                        'title' => $chapterTitle,
                        'content' => strip_tags($readyChapterContent)
                    ]
                );
            }
        } else {
            throw new \Exception('File no table of contents');
        }

        return $chapters;
    }

    public function getTranslators(): string
    {
        return '';
    }

    public function getAnnotation()
    {
        return '';
    }

    /**
     * @param $archiveFile
     * @return \SimpleXMLElement
     * @throws \Exception
     */
    private function readDocx($archiveFile)
    {
        $zip = new ZipArchive;
        if ($zip->open($archiveFile) === true) {
            $string = $zip->getFromName('word/document.xml');
            $xml = simplexml_load_string($string);
            $zip->close();
            return $xml;
        }
        throw new \Exception('File not open');
    }

    public function getGenres()
    {
        return [];
    }

    public function getNotice()
    {
        return [];
    }


    private function xmlConvertText()
    {
        $text = $this->file->asXML();

        $start = stripos($text, '<w:sdtContent>', 0);
        $end = stripos($text, '</w:sdtContent>', 0);

        if(!$start && !$end){
            $start = stripos($text, '<w:hyperlink', 0);
            $end = strrpos($text, '</w:hyperlink>', 0);
        }

        $length = $end - $start;
        $content = substr_replace($text, '', $start, $length);

        $replaceNewlines = preg_replace('/<w:p w[0-9-Za-z]+:[a-zA-Z0-9]+="[a-zA-z"0-9 :="]+">/', "\n\r", $content);
        $replaceTableRows = preg_replace('/<w:tr>/', "\n\r", $replaceNewlines);
        $replaceTab = preg_replace('/<w:tab\/>/', "\t", $replaceTableRows);
        $replaceParagraphs = preg_replace('/<\/w:p>/', "\n\r", $replaceTab);
        $replaceOtherTags = strip_tags($replaceParagraphs);
        return $replaceOtherTags;
    }
}
