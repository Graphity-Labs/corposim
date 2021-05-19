<?php declare(strict_types=1);

namespace App;

use Exception;
use App\Core\Request;
use App\Core\Response;
use Bramus\Router\Router;
use App\Renderer\RendererFactory;
use App\Controller\ControllerFactory;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Kernel
{
    /**
     * @var string
     */
    private string $environment;

    /**
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function handle(): Response
    {
        $controllerFactory = new ControllerFactory();

        $request = new Request($_REQUEST);
        $container = $this->configureContainer();
        $renderer = new RendererFactory();
        $router = $this->configureRouter();

        $controller = $controllerFactory->create($request, $container, $renderer, $router);

        return $controller->get();
    }

    /**
     * @return ContainerBuilder
     * @throws Exception
     */
    private function configureContainer(): ContainerBuilder
    {
        $containerBuilder = new ContainerBuilder();
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.yaml');

        return $containerBuilder;
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
}
