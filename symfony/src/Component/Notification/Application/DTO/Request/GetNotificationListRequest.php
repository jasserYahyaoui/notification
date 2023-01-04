<?php

namespace App\Component\Notification\Application\DTO\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @todo create unit test with data provider to test user Ids Regex
 */
class GetNotificationListRequest implements RequestInterface
{
    private string $userId;

    public function __construct(array $data)
    {
        $data = $this->resolve($data);

        $this->userId = $data['userId'];
    }

    public function getUserId(): string
    {
        return $this->userId;
    }


    private function resolve(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver->setDefined(['userId']);
        $resolver
            ->setRequired(['userId'])
            ->setAllowedTypes('userId', ['string'])
            ->setAllowedValues('userId', function ($value) {
                return preg_match('/^[1-9][0-9]*$/', $value);
            })
        ;

        return $resolver->resolve($data);
    }
}