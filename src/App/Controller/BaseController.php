<?php

namespace App\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;

class BaseController
{
    protected function redirectToRoute()
    {
        var_dump('redirect to route');
    }

    /**
     * @return array
     */
    protected function getRequestBody(): ?array
    {
        $requestFactory = new Psr17Factory();
        $queryString = $requestFactory->createStreamFromFile('php://input');

        if (!isset($queryString) || empty($queryString) || $queryString === '') {
            return null;
        }

        $data = [];
        parse_str($queryString->getContents(), $data);

        return $data;
    }
}
