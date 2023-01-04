<?php

namespace App\Component\Notification\Application\Action;

use App\Component\Notification\Application\DTO\Request\RequestInterface;
use App\Component\Notification\Application\DTO\Response\CheckNotificationResponse;
use App\Component\Notification\Application\DTO\Response\ReadNotificationResponse;
use App\Component\Notification\Application\DTO\Response\ResponseInterface;
use App\Component\Notification\Domain\Manager\NotificationManager;

/**
 * Class ReadNotificationAction
 * @package App\Component\Notification\Application\Action
 */
class ReadNotificationAction implements ActionInterface
{
    private NotificationManager $notificationManager;

    public function __construct(NotificationManager $notificationManager)
    {
        $this->notificationManager = $notificationManager;
    }

    public function execute(RequestInterface $request): ResponseInterface
    {
        $this->notificationManager->readNotification($request->getNotificationId());

        return new ReadNotificationResponse();
    }
}