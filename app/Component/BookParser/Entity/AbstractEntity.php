<?php
namespace App\Component\BookParser\Entity;

/**
 * Class AbstractEntity
 */
abstract class AbstractEntity
{

    /**
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $arrayObjectProperty = get_class_vars(static::class);

        foreach ($arrayObjectProperty as $key => $property) {
            if (!empty($params[$key])) {
                $this->$key = $params[$key];
            }
        }
    }

}
