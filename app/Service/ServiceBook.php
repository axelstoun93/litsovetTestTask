<?php

namespace App\Service;

use App\Models\BookChapters;
use App\Models\BookPages;

class ServiceBook
{

    private $bookPagesModel;
    private $bookChapterModel;

    public function __construct()
    {
        $this->bookPagesModel = new BookPages();
        $this->bookChapterModel = new BookChapters();
    }

    public function getChapterMenu($bookId)
    {
        $contentPage = $this->bookPagesModel->getChapterPage($bookId)->getResultArray();
        $bookMenu = [];

        $firstPage = $contentPage[0]['id'];

        foreach ($contentPage as $key => $page) {
                $pageInt = $page['id'] - $firstPage;
                $bookMenu[] = [
                    'page_number' => ++$pageInt,
                    'chapter_title' => $page['chapter_title'],
                     'views' => $page['views']
                ];
        }
        return $bookMenu;
    }


    public function addVoteChapter($chapterID, $chapterTitle): void
    {
        if ($chapterTitle) {
            $this->bookChapterModel->query(
                'UPDATE `book_chapters` SET `views` = `views` + 1 WHERE `id` = ?',
                $chapterID
            );
        }
    }


}
