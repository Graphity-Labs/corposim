<?php declare(strict_types=1);

namespace App\Controller;

use Twig\Environment;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class ControllerFactory
{
    /**
     * @param string $environment
     * @param ServerRequestInterface $request
     * @param ResponseFactoryInterface $responseFactory
     * @param array $routes
     * @param Environment $renderer
     * @return ControllerInterface
     */
    public function create(
        string $environment,
        ServerRequestInterface $request,
        ResponseFactoryInterface $responseFactory,
        array $routes,
        Environment $renderer
    ): ControllerInterface {
        $uri = $request->getUri()->getPath() !== '/'
            ? rtrim($request->getUri()->getPath(), '/\\')
            : $request->getUri()->getPath();

        // handle 404
        if (!isset($routes[$uri])) {
            $template = 'pages/error/404.html.twig';
            return new NotFoundController($environment, $request, $responseFactory, $renderer, $template);
        }

        $controller = $routes[$uri]['class'];
        $template = $routes[$uri]['template'];

        return new $controller($environment, $request, $responseFactory, $renderer, $template);
    }
}
