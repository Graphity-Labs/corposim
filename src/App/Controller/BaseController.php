<?php

namespace App\Controller;

class BaseController
{
    protected function redirectToRoute()
    {
        var_dump('redirect to route');
    }
}
