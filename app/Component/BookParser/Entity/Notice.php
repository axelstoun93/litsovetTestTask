<?php

namespace App\Component\BookParser\Entity;

/**
 * Class Notice
 */
class Notice extends AbstractEntity
{

    /**
     * @var int
     */
    public int $number;
    /**
     * @var string
     */
    public string $description;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }
}
