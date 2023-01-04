<?php

namespace App\Component\Notification\Application\DTO\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @todo create unit test with data provider to test notification Ids Regex
 */
class CheckNotificationRequest implements RequestInterface
{
    private string $notificationId;

    public function __construct(array $data)
    {
        $data = $this->resolve($data);

        $this->notificationId = $data['notificationId'];
    }

    public function getNotificationId(): string
    {
        return $this->notificationId;
    }


    private function resolve(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver->setDefined(['notificationId']);
        $resolver
            ->setRequired(['notificationId'])
            ->setAllowedTypes('notificationId', ['string'])
            ->setAllowedValues('notificationId', function ($value) {
                return preg_match('/^[1-9][0-9]*$/', $value);
            })
        ;

        return $resolver->resolve($data);
    }
}