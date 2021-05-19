<?php

namespace App\Renderer;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RendererFactory
{
    public function create(): Environment
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../../templates');

        return new Environment($loader);
    }
}
