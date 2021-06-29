<?php declare(strict_types=1);

namespace App;

use Exception;
use Twig\Environment;
use Bramus\Router\Router;
use Symfony\Component\Yaml\Yaml;
use App\Renderer\RendererFactory;
use App\Controller\ControllerFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Kernel implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $environment = $this->configureEnvironment($_SERVER['SERVER_NAME']);
        $router = $this->configureRouter();
        $routes = $this->retrieveRoutes();
        $renderer = $this->configureRenderer();

        $responseFactory = new Psr17Factory();
        $controllerFactory = new ControllerFactory();

        $controller = $controllerFactory->create($environment, $request, $responseFactory, $routes, $renderer);

        $response = null;

        if ($request->getMethod() === 'GET') {
            $router->get(
                $request->getUri()->getPath(),
                function () use ($controller, &$response) {
                    $response = $controller->get();
                }
            );
        }

        if ($request->getMethod() === 'POST') {
            $router->post(
                $request->getUri()->getPath(),
                function () use ($controller, &$response) {
                    $response = $controller->post();
                }
            );
        }

        $router->run();

        return $response;
    }

    /**
     * @param string $serverName
     * @return string
     */
    private function configureEnvironment(string $serverName): string
    {
        if ($serverName === 'kst.ddev.site') return 'development';
        if ($serverName === 'kstsecurity.nl') return 'production';

        return 'invalid';
    }

    /**
     * @return Router
     */
    private function configureRouter(): Router
    {
        $router = new Router;
        $router->setBasePath('/');

        return $router;
    }

    /**
     * @return array
     */
    private function retrieveRoutes(): array
    {
        return Yaml::parseFile(__DIR__ . '/Config/routes.yaml');
    }

    /**
     * @return Environment
     */
    private function configureRenderer(): Environment
    {
        $rendererFactory = new RendererFactory();

        return $rendererFactory->create();
    }
}
