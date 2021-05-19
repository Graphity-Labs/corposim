<?php declare(strict_types=1);

namespace App\Controller;

use App\Core\Route;
use App\Core\Request;
use Bramus\Router\Router;
use Symfony\Component\Yaml\Yaml;
use App\Renderer\RendererFactory;
use Symfony\Component\DependencyInjection\Container;

class ControllerFactory
{
    /**
     * @var ControllerInterface
     */
    private ControllerInterface $controller;

    /**
     * @param Request $request
     * @param Container $container
     * @param RendererFactory $renderer
     * @param Router $router
     * @return ControllerInterface
     */
    public function create(
        Request $request,
        Container $container,
        RendererFactory $renderer,
        Router $router
    ): ControllerInterface {
        $routes = $this->retrieveRoutes();
        $route = $this->configureRoute($router);
        $uri = $route->getUri();

        if ($this->routeFound($uri, $routes) === true) {
            $controller = $routes[$uri]['class'];

            $router->get($uri, function () use ($request, $container, $renderer, $uri, $route, $controller) {
                $this->controller = new $controller($request, $container, $renderer, $route);
            });
        } else {
            $this->controller = new NotFoundController($request, $container, $renderer, $route);
        }

        $router->run();

        return $this->controller;
    }

    /**
     * @param Router $router
     * @return Route
     */
    private function configureRoute(Router $router): Route
    {
        $route = new Route();
        $route->setUri($router->getCurrentUri());

        return $route;
    }

    /**
     * @return array
     */
    private function retrieveRoutes(): array
    {
        return Yaml::parseFile(__DIR__ . '/../../../config/routes.yaml');
    }

    /**
     * @param string $uri
     * @param array $routes
     * @return bool
     */
    private function routeFound(string $uri, array $routes): bool
    {
        return array_key_exists($uri, $routes);
    }
}
