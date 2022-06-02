<?php

namespace App\Controllers;

use App\Decorator\BookPageDecorator;
use App\Models\Book;
use App\Models\BookPages;
use App\Service\Pager\BookPager;
use App\Service\ServiceBook;
use Config\Services as AppServices;

class BookController extends AbstractController
{

    private $serviceBook;
    private $bookPagesModel;
    private $bookModel;

    public function __construct()
    {
        parent::__construct();
        $this->serviceBook = new ServiceBook();
        $this->bookPagesModel = new BookPages();
        $this->bookModel = new Book();
        $this->template = 'template/book';
    }


    public function index($bookId)
    {
        $this->template = 'template/book';

        $book = $this->bookModel->find($bookId);
        $this->vars['title'] = $book['name'];
        $this->vars['description'] = $book['description'];

        $chapterMenu = $this->serviceBook->getChapterMenu($bookId);

        $contentPage = $this->bookPagesModel->getPagesByBookId($bookId, 0);
        $bookPageDecorator = new BookPageDecorator($contentPage);

        $this->vars['content'] = $this->parser->setData(
            [
             'page' => $bookPageDecorator,
             'chapter_menu' => $chapterMenu,
             'book_id' => $bookId

            ])->render('pages/book/index');

        $this->serviceBook->addVoteChapter($contentPage['chapter_id'],$contentPage['chapter_title']);

        return $this->renderOutput();
    }

    public function show($bookId, $page)
    {
        $this->template = 'template/book_show';

        $book = $this->bookModel->find($bookId);
        $this->vars['title'] = $book['name'] . " - страница $page";
        $this->vars['description'] = $book['description'] . " - страница $page";

        $pager = new BookPager(config('Pager'), AppServices::renderer());

        $pager->setPath("$bookId");

        $chapterMenu = $this->serviceBook->getChapterMenu($bookId);

        $totalPage = $this->bookPagesModel->getTotalPage($bookId);
        $pagePaginator = $pager->makeLinks($page, 1, $totalPage, 'bootstrap_paginate');

        $contentPage = $this->bookPagesModel->getPagesByBookId($bookId, --$page);

        $bookPageDecorator = new BookPageDecorator($contentPage);

        $this->serviceBook->addVoteChapter($contentPage['chapter_id'],$contentPage['chapter_title']);


        $this->vars['content'] = $this->parser->setData(
            [
                'page' => $bookPageDecorator,
                'paginator' => $pagePaginator,
                'chapter_menu' => $chapterMenu,
                'book_id' => $bookId
            ]
        )->render('pages/book/show');

        return $this->renderOutput();
    }

}
