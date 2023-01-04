<?php

namespace App\Component\Notification\Application\DTO\Response;

use App\Entity\NotificationStat;

/**
 * @todo create unit test with Prophecy to test responses
 */
class GetStatNotificationResponse implements ResponseInterface
{
    private NotificationStat $notificationStat;

    public function __construct(NotificationStat $notificationStat)
    {
        $this->notificationStat = $notificationStat;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(array $context = []): array
    {
        if (0 === $this->notificationStat->getCountTotal()) {
            return ['message' => 'You dont have any notification yet !'];
        }

        return [
            'notifications' => [
                'readed' => $this->notificationStat->getCountRead(),
                'unreaded' => $this->notificationStat->getCountUnread(),
                'total' => $this->notificationStat->getCountTotal(),
            ]
        ];
    }
}