<?php

namespace App\Component\Notification\Application\DTO\Response;

use App\Entity\CheckNotification;
use App\Entity\NotificationCollection;

/**
 * @todo create unit test with Prophecy to test responses
 */
class CheckNotificationResponse implements ResponseInterface
{
    private CheckNotification $checkNotification;

    public function __construct(CheckNotification $checkNotification)
    {
        $this->checkNotification = $checkNotification;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(array $context = []): array
    {
        if (null === $this->checkNotification->isRead()) {
            return ['message' => 'This notification Id does not exist'];
        }

        return [
            'notification' => [
                'isRead' => $this->checkNotification->isRead(),
            ]
        ];
    }
}