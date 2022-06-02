<?php

namespace App\Component\BookParser\Entity;

/**
 * Class Genre
 * @package App\Component\BookParser\Entity
 */
class Genre extends AbstractEntity
{

    /**
     * @var string
     */
    public string $name;

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }
}
