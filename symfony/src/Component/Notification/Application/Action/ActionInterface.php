<?php

namespace App\Component\Notification\Application\Action;
use App\Component\Notification\Application\DTO\Request\RequestInterface;
use App\Component\Notification\Application\DTO\Response\ResponseInterface;

/**
 * Interface ActionInterface
 * @package App\Component\Notification\Application\Action
 */
interface ActionInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request): ResponseInterface;
}