<?php

namespace App\Controllers;

use App\Service\ServiceBookLoader;

class LoadBookController extends AbstractController
{

    private $serviceBookLoader;

    public function __construct()
    {
        parent::__construct();
        $this->template = 'template/book_load';
        $this->serviceBookLoader = new ServiceBookLoader();
    }

    public function index()
    {
        $this->vars['content'] = $this->parser->render('pages/load-book/index');
        return $this->renderOutput();
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules(
            [
                'book' => 'max_size[book,10240]|ext_in[book,fb2,docx]',
            ]
        );

        if ($validation->run() === false) {
            $validation->getErrors();
            $this->response->setStatusCode('422');
            return $this->response->setJSON(['errors' => $validation->getErrors()]);
        }

        $bookFileName = $this->request->getFile('book')->getName();

        $getTypeFile = function ($fileName) {
            $explodeFile = explode('.', $fileName);
            return $explodeFile[array_key_last($explodeFile)];
        };


        try {
            list($bookId, $pageCount) = $this->serviceBookLoader->loadBookByType(
                $getTypeFile($bookFileName),
                $this->request->getFile(
                    'book'
                )->getName(),
                $this->request->getFile(
                    'book'
                )->getPathname()
            );
        } catch (\Exception $exception) {
            $validation->getErrors();
            $this->response->setStatusCode('422');
            return $this->response->setJSON(['errors' => [$exception->getMessage()]]);
        }


        $this->response->setStatusCode('200');

        $redirect_url = route_to('book_page', $bookId);

        if ($pageCount > 1) {
            $redirect_url = route_to('book_page_show', $bookId, 1);
        }

        return $this->response->setJSON(
            [
                'redirect_url' => $redirect_url
            ]
        );
    }

}
