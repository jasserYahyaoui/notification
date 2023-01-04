<?php

namespace App\Component\Notification\Application\DTO\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Component\Notification\Application\DTO\Request\CheckNotificationRequest;

class ReadNotificationRequest extends CheckNotificationRequest implements RequestInterface
{
}