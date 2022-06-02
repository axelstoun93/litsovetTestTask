<?php

namespace App\Component\BookParser\Data;

interface BookParserInterface {

    public function getAuthors();

    public function getTitle();

    public function getChapters();

    public function getTranslators();

    public function getAnnotation();

    public function getGenres();

    public function getNotice();

}
