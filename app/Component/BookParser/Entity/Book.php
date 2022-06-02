<?php

namespace App\Component\BookParser\Entity;

/**
 * Class Book
 */
class Book extends AbstractEntity
{

    /**
     *
     */
    const DEFAULT_TITLE = 'Неизвестное название';

    /**
     * @var string
     */
    public string $title;

    /**
     * @var array
     */
    public array $authors = [];

    /**
     * @var string
     */
    public string $annotation = '';

    /**
     * @var array
     */
    public array $translators = [];

    /**
     * @var array
     */
    public array $chapters = [];

    /**
     * @var array
     */
    public array $genres = [];

    /**
     * @var array
     */
    public array $notice = [];

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title ?? self::DEFAULT_TITLE;
    }

    /**
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @return string
     */
    public function getAnnotation()
    {
        if (empty($this->annotation) and !empty($this->getChapters())) {
            $first = $this->getChapters()[0];
            return mb_substr($first->getContent(), 0, 200);
        }

        return $this->annotation;
    }

    /**
     * @return array
     */
    public function getTranslators()
    {
        return $this->translators;
    }

    /**
     * @return array
     */
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @return array
     */
    public function getNotice()
    {
        return $this->notice;
    }
}
