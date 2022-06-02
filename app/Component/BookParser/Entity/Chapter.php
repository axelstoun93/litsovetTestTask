<?php

namespace App\Component\BookParser\Entity;

/**
 * Class Chapter
 */
class Chapter extends AbstractEntity
{

    /**
     * @var int
     */
    protected int $id;
    /**
     * @var string
     */
    protected string $title;

    /**
     * @var array
     */
    protected array $subtitle;

    /**
     * @var string
     */
    protected string $content;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param $value
     */
    public function setContent($value): void
    {
        $this->content = $value;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $value
     */
    public function setTitle(string $value): void
    {
        $this->title = $value;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

}
