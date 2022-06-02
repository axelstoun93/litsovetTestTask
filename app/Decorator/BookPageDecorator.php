<?php
namespace App\Decorator;


class BookPageDecorator
{

    private $title;
    private $content;

    public function __construct($bookPageArray)
    {
        $this->setChapterTitle($bookPageArray['chapter_title']);
        $this->setContent($bookPageArray['content']);
    }


    public function getContent()
    {
        return $this->content;
    }


    public function getChapterTitle()
    {
        return $this->title;
    }


    private function setContent($content)
    {
        $this->content = $this->nl2p($content);
    }

    private function setChapterTitle($title)
    {
        $this->title = $title;
    }

    private function nl2p($string)
    {
        return $string_with_paragraphs = "<p>" . implode("</p><p>", explode("\n", $string)) . "</p>";
    }

}
