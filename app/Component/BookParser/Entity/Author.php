<?php

namespace App\Component\BookParser\Entity;

/**
 * Class Author
 */
class Author extends AbstractEntity
{
    /**
     * @var string
     */
    public string $firstName = '';
    /**
     * @var string
     */
    public string $middleName = '';
    /**
     * @var string
     */
    public string $lastName = '';

    /**
     * @var string
     */
    public string $nickname = '';

    /**
     * @var string
     */
    public string $email = '';

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return '';
    }
}
