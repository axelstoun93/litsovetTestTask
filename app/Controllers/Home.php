<?php

namespace App\Controllers;

use App\Component\BookParser\Docx\DocxParser;
use App\Component\BookParser\Entity\BookFactory;
use App\Component\BookParser\Entity\Book;
use App\Component\BookParser\Fb2\Fb2Parser;

class Home extends BaseController
{
    public function index()
    {

        $book = new \App\Models\Book();
        $result = $book->save([
            'name' => 'test'
        ]);

        var_dump($book->getInsertID());


        die;
        $content = view('pages/load-book/index');
        $sidebar = view('layout/default/sidebar');
        $footer = view('layout/default/footer');

        return view('template/load_book',['content' => $content,'sidebar' => $sidebar,'footer' => $footer]);

        die;

        $data = [
            'header'        => 'layout/page/default/header',
            'style'         => 'partials/style/_public_css',
            'content'       => 'load_book_page',
            'footer'        => 'layout/page/default/footer',
        ];

        echo view('layout/default/header')->render();
        echo view('layout/default/menu');
        echo view('load_book_page');
        echo view('layout/default/footer');
        die;


   /*     return view('layout/page',$data);

        die;*/


        $this->load->view('template', $data);

        $content = view('load_book');
        return view('layout/page',['content' => $content]);
       /* $file = file_get_contents(FCPATH.'5.docx');*/
        $test = new DocxParser(FCPATH.'6.docx');
        $test->getChapters();
        die;
/*        $parser = new Fb2Parser($file);
        $bookFactory = new BookFactory();
        $book = $bookFactory->create($parser);
        var_dump($book);*/
        return view('welcome_message');
    }


    public function nl2p($string){
        return $string_with_paragraphs = "<p>".implode("</p><p>", explode("\n", $string))."</p>";
    }
}
