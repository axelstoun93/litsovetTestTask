<?php

namespace App\Controllers;

use App\Controllers\BaseController;

abstract class AbstractController extends BaseController
{

    protected $template;
    protected $parser;
    protected $vars = [];

    public function __construct(){
        $this->parser = \Config\Services::renderer();
    }

    protected function renderOutput()
    {
        $sidebar =  $this->parser->render('layout/default/sidebar');
        $this->vars['sidebar'] = $sidebar;
        $footer =  $this->parser->render('layout/default/footer');
        $this->vars['footer'] = $footer ;
        return view($this->template,$this->vars);
    }

}
