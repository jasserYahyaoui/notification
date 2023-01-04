<?php
/**
 * Created by PhpStorm.
 * User: hibac
 * Date: 02/01/2023
 * Time: 20:39
 */

namespace App\Entity;


class CheckNotification
{
    private ?bool $isRead = null;

    /**
     * @return bool|null
     */
    public function isRead():?bool
    {
        return $this->isRead;
    }

    /**
     * @param bool $isRead
     * @return $this
     */
    public function setIsRead(bool $isRead)
    {
        $this->isRead = $isRead;
        return $this;
    }
}