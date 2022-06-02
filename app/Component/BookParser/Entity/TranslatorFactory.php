<?php

namespace App\Component\BookParser\Entity;

/**
 * Class TranslatorFactory
 */
class TranslatorFactory
{
    /**
     * @param array $chapterArray
     * @return Translator
     */
    public function create(array $chapterArray)
    {
        $chapter = new Translator();
        $chapter->setParams($chapterArray);
        return $chapter;
    }
}
