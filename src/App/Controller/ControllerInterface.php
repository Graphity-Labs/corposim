<?php declare(strict_types=1);

namespace App\Controller;

use App\Core\Route;
use App\Core\Request;
use App\Core\Response;
use App\Renderer\RendererFactory;
use Symfony\Component\DependencyInjection\Container;

interface ControllerInterface
{
    /**
     * @param Request $request
     * @param Container $container
     * @param RendererFactory $renderer
     * @param Route $route
     */
    public function __construct(Request $request, Container $container, RendererFactory $renderer, Route $route);

    /**
     * @return Response
     */
    public function get(): Response;

    /**
     * @return Response
     */
    public function post(): Response;
}