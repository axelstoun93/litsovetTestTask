<?php

namespace App\Component\BookParser\Entity;

/**
 * Class NoticeFactory
 */
class NoticeFactory
{

    /**
     * @param array $paramArray
     * @return Notice
     */
    public function create(array $paramArray)
    {
        $notice = new Notice();
        $notice->setParams($paramArray);
        return $notice;
    }

}
