<?php

namespace App\Component\BookParser\Entity;

/**
 * Class GenreFactory
 */
class GenreFactory
{
    /**
     * @param array $chapterArray
     * @return Genre
     */
    public function create(array $chapterArray)
    {
        $chapter = new Genre();
        $chapter->setParams($chapterArray);
        return $chapter;
    }
}
