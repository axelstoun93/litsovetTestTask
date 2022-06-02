<?php
namespace App\Component\BookParser\Entity;

use App\Component\BookParser\Data\BookParserInterface;

/**
 * Class BookFactory
 */

class BookFactory {

    /**
     * @param BookParserInterface $bookParser
     * @return Book
     */
    public function create(BookParserInterface $bookParser){
        $book =  new Book();
        $book->setParams([
            'authors' => $bookParser->getAuthors(),
            'title' => $bookParser->getTitle(),
            'translators' => $bookParser->getTranslators(),
            'chapters' => $bookParser->getChapters(),
            'annotation' => $bookParser->getAnnotation()
        ]);
        return $book;
    }

}
