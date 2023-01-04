<?php
namespace App\Entity;

/**
 * Class NotificationStat
 * @package App\Entity
 */
class NotificationStat
{
    private int $countRead = 0;
    private int $countUnread = 0;
    private int $countTotal = 0;

    /**
     * @return int
     */
    public function getCountRead()
    {
        return $this->countRead;
    }

    /**
     * @param int $countRead
     * @return NotificationStat
     */
    public function setCountRead($countRead)
    {
        $this->countRead = $countRead;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountUnread()
    {
        return $this->countUnread;
    }

    /**
     * @param int $countUnread
     * @return NotificationStat
     */
    public function setCountUnread($countUnread)
    {
        $this->countUnread = $countUnread;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountTotal()
    {
        return $this->countTotal;
    }

    /**
     * @param int $countTotal
     * @return NotificationStat
     */
    public function setCountTotal($countTotal)
    {
        $this->countTotal = $countTotal;
        return $this;
    }
}