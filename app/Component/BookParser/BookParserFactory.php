<?php

namespace App\Component\BookParser;

use App\Component\BookParser\Docx\DocxParser;
use App\Component\BookParser\Entity\Book;
use App\Component\BookParser\Fb2\Fb2Parser;

/**
 * Class BookParserFactory
 * @package App\Component\BookParser
 */
class BookParserFactory
{

    /**
     * @param string $typeFile
     * @param $file
     * @return Book
     * @throws \Exception
     */
    public function create(string $typeFile, string $fileName, string $file): Book
    {

        if ($typeFile === 'docx') {
            $parser = new DocxParser($file);
            $parser->setTitle($fileName);
            $book = new Book();
            $book->setParams(
                [
                    'title' => $parser->getTitle(),
                    'authors' => $parser->getAuthors(),
                    'annotation' => $parser->getAnnotation(),
                    'translators' => $parser->getTranslators(),
                    'chapters' => $parser->getChapters(),
                    'genres' => $parser->getGenres(),
                    'notice' => $parser->getNotice(),
                ]
            );
            return $book;
        }

        if ($typeFile === 'fb2') {
            $parser = new Fb2Parser($file);
            $book = new Book();
            $book->setParams(
                [
                    'title' => $parser->getTitle(),
                    'authors' => $parser->getAuthors(),
                    'annotation' => $parser->getAnnotation(),
                    'translators' => $parser->getTranslators(),
                    'chapters' => $parser->getChapters(),
                    'genres' => $parser->getGenres(),
                    'notice' => $parser->getNotice(),
                ]
            );
            return $book;
        }

        throw new \Exception('File type is not supported');
    }

}
