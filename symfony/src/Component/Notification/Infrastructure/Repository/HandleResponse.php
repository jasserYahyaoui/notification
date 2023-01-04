<?php

namespace App\Component\Notification\Infrastructure\Repository;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerInterface;

trait HandleResponse
{
//    private SerializerInterface $serializer;
//    public function __construct(SerializerInterface $serializer)
//    {
//        $this->serializer = $serializer;
//    }

    public function handleResponse(array $response, string $type, array $context = []): mixed
    {
        $deserializeContext = new DeserializationContext();
        $deserializeContext->setAttribute('context', $context);

        $response = json_encode($response);

        return $this->serializer->deserialize($response, $type, 'json', $deserializeContext);
    }

    private function getFormat(string $contentType):string|null
    {
        $format = null;

        if (preg_match('#application/json#', $contentType)) {
            $format = 'json';
        } elseif (preg_match('#application/xml#', $contentType)) {
            $format = 'xml';
        }

        if (null === $format) {
            throw new \RuntimeException(sprintf('Unsupported Content-type "%s".', $contentType));
        }

        return $format;
    }
}