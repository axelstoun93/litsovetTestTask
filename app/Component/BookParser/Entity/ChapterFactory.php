<?php

namespace App\Component\BookParser\Entity;

/**
 * Class ChapterFactory
 */
class ChapterFactory
{

    /**
     * @param array $chapterArray
     * @return Chapter
     */
    public function create(array $chapterArray)
    {
        $chapter = new Chapter();
        $chapter->setParams($chapterArray);
        return $chapter;
    }

}
