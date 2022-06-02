<?php
namespace App\Component\BookParser\Entity;

/**
 * Class AuthorFactory
 */
class AuthorFactory
{

    /**
     * @param array $authorArray
     * @return Author
     */
    public function create(array $authorArray)
    {
        $author = new Author();
        $author->setParams($authorArray);
        return $author;
    }

}
