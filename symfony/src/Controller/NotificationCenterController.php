<?php

namespace App\Controller;

use App\Component\Notification\Application\Action\CheckNotificationAction;
use App\Component\Notification\Application\Action\GetNotificationListAction;
use App\Component\Notification\Application\Action\GetStatNotificationAction;
use App\Component\Notification\Application\Action\ReadNotificationAction;
use App\Component\Notification\Application\DTO\Request\CheckNotificationRequest;
use App\Component\Notification\Application\DTO\Request\GetNotificationListRequest;
use App\Component\Notification\Application\DTO\Request\GetStatNotificationRequest;
use App\Component\Notification\Application\DTO\Request\ReadNotificationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_notification_center')]
class NotificationCenterController extends AbstractController
{
    #[Route('/notification/user/{userId}', name: "api_notification_user", methods: ['GET'])]
    public function apiGetUserNotification(
        Request                   $request,
        GetNotificationListAction $action
    ): JsonResponse
    {
        try {
            $response = $action->execute(new GetNotificationListRequest([
                'userId' => $request->attributes->get('userId'),
            ]));

            return $this->json($response->getData(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/stat/notification/user/{userId}', name: "api_stat_notification_user", methods: ['GET'])]
    public function apiGetNotificationStat(
        Request                   $request,
        GetStatNotificationAction $action
    ): JsonResponse
    {
        try {
            $response = $action->execute(new GetNotificationListRequest([
                'userId' => $request->attributes->get('userId'),
            ]));

            return $this->json($response->getData(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/check/notification/{notificationId}', name: "api_check_notification", methods: ['GET'])]
    public function apiCheckNotification(
        Request                 $request,
        CheckNotificationAction $action
    ): JsonResponse
    {
        try {
            $response = $action->execute(new CheckNotificationRequest([
                'notificationId' => $request->attributes->get('notificationId'),
            ]));
            return $this->json($response->getData(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/read/notification/{notificationId}', name: "api_read_notification", methods: ['GET'])]
    public function apiReadNotification(
        Request                $request,
        ReadNotificationAction $action
    ): JsonResponse
    {
        try {
            $action->execute(new ReadNotificationRequest([
                'notificationId' => $request->attributes->get('notificationId')
            ]));

            return $this->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
