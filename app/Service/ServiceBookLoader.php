<?php

namespace App\Service;

use App\Component\BookParser\BookParserFactory;
use App\Component\BookParser\Helper\BookPageSeparator;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookChapters;
use App\Models\BookGenre;
use App\Component\BookParser\Entity\Book as BookEntity;
use App\Models\BookNotice;
use App\Models\BookPages;

class ServiceBookLoader {

    private $bookParserFactory;
    private $bookModel;
    private $bookAuthorModel;
    private $bookChapterModel;
    private $bookGenreModel;
    private $bookNoticeModel;
    private $bookPageSeparator;
    private $bookPageModel;

    public function __construct(){
        $this->bookParserFactory = new BookParserFactory();
        $this->bookModel = new Book();
        $this->bookAuthorModel = new BookAuthor();
        $this->bookGenreModel = new BookGenre();
        $this->bookChapterModel = new BookChapters();
        $this->bookNoticeModel = new BookNotice();
        $this->bookPageModel = new BookPages();
        $this->bookPageSeparator = new BookPageSeparator();
    }

    public function loadBookByType(string $type,string $fileName,string $patchFile)
    {
        $book = $this->bookParserFactory->create($type,$fileName,$patchFile);

        $this->bookModel->save(
            [
                'name' => $book->getTitle(),
                'description' => $book->getAnnotation()
            ]
        );

        $bookId = $this->bookModel->getInsertID();

        $this->saveAuthors($book);
        $this->saveGenres($book);
        $this->saveNotice($book, $bookId);
        $chapterIds = $this->saveChapters($book, $bookId);

        $countPage = $this->savePage($book,$bookId,$chapterIds);
        return [$bookId,$countPage];

    }


    private function saveAuthors(BookEntity $book)
    {
        $authors = $book->getAuthors();

        $arrayAuthorIds = [];

        if (!empty($authors)) {
            $arrayInsert = [];

            foreach ($authors as $author) {
                $arrayInsert[] = [
                    'first_name' => $author->getFirstName(),
                    'middle_name' => $author->getMiddleName(),
                    'last_name' => $author->getLastName()
                ];
            }

            $arrayAuthorIds = $this->bookAuthorModel->saveAuthors($arrayInsert);
        }

        return $arrayAuthorIds;
    }

    private function saveGenres(BookEntity $book)
    {
        $genres = $book->getGenres();
        $arrayAuthorIds = [];

        if (!empty($genres)) {
            $arrayInsert = [];

            foreach ($genres as $genre) {
                $arrayInsert[] = [
                    'name' => $genre->getName()
                ];
            }

            $arrayAuthorIds = $this->bookGenreModel->saveGenres($arrayInsert);
        }

        return $arrayAuthorIds;
    }

    private function saveChapters(BookEntity $book, $bookId)
    {
        $chapters = $book->getChapters();
        $chapterIds = [];

        if (!empty($chapters)) {
            $arrayInsert = [];

            foreach ($chapters as $chapter) {
                $arrayInsert[] = [
                    'name' => $chapter->getTitle(),
                    'content' => $chapter->getContent(),
                    'book_id' => $bookId
                ];
            }
            $chapterIds = $this->bookChapterModel->saveChapters($arrayInsert);
        }

        return $chapterIds;
    }


    private function saveNotice(BookEntity $book,$bookId){
        $notices = $book->getNotice();


        if (!empty($notices)) {
            $arrayInsert = [];

            foreach ($notices as $notice) {
                $arrayInsert[] = [
                    'number' => $notice->getNumber(),
                    'description' => $notice->getDescription(),
                    'book_id' => $bookId
                ];
            }

            $result = $this->bookNoticeModel->insertBatch($arrayInsert);

        }
    }

    private function savePage($book,$bookId,$chapterIds){
        $chapters = $book->getChapters();
        $countPages = 0;

        if (!empty($chapters)) {

            foreach ($chapters as $key => $chapter) {
                $chapter->setId($chapterIds[$key]);
                $pages = $this->bookPageSeparator->getPageChapter($bookId,$chapter);
                $countPages =  $countPages + count($pages);
                $this->bookPageModel->insertBatch($pages);
            }

        }

        return $countPages;

    }



}
