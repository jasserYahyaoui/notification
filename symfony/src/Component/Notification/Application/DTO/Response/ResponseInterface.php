<?php
/**
 * Created by PhpStorm.
 * User: hibac
 * Date: 30/12/2022
 * Time: 19:34
 */

namespace App\Component\Notification\Application\DTO\Response;


interface ResponseInterface
{
    /**
     * Get data presented by the DTO response object.
     *
     * @param array $context
     *
     * @return array
     */
    public function getData(array $context = []) : array;
}