<?php

namespace App\Component\Notification\Domain\Manager;

use App\Component\Notification\Infrastructure\Repository\NotificationRepository;
use App\Entity\CheckNotification;
use App\Entity\NotificationCollection;
use App\Entity\NotificationStat;

/**
 * @todo create unit test with Prophecy and data provider to test different response with specific id
 */
class NotificationManager
{
    private NotificationRepository $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getNotificationList(string $userId):NotificationCollection|array
    {
        return $this->notificationRepository->browseNotificationByUserId($userId);
    }

    public function getStatNotification(string $userId): NotificationStat
    {
        return $this->notificationRepository->getStatNotificationByUserId($userId, 0);
    }

    public function checkNotification(string $notificationId): CheckNotification
    {
        return $this->notificationRepository->checkNotification($notificationId);
    }

    public function readNotification(string $notificationId): void
    {
        $this->notificationRepository->readNotification($notificationId);
    }
}