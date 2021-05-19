<?php declare(strict_types=1);

namespace App\Controller;

use App\Core\Route;
use App\Core\Request;
use App\Core\Response;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;
use App\Renderer\RendererFactory;
use Symfony\Component\DependencyInjection\Container;

class NotFoundController extends BaseController implements ControllerInterface
{
    /**
     * @var Request
     */
    private Request $request;

    /**
     * @var Container
     */
    private Container $container;

    /**
     * @var RendererFactory
     */
    private RendererFactory $rendererFactory;

    /**
     * @var Route
     */
    private Route $route;

    /**
     * @param Request $request
     * @param Container $container
     * @param RendererFactory $renderer
     * @param Route $route
     */
    public function __construct(Request $request, Container $container, RendererFactory $renderer, Route $route)
    {
        $this->request = $request;
        $this->container = $container;
        $this->rendererFactory = $renderer;
        $this->route = $route;
    }

    /**
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function get(): Response
    {
        $content = $this->rendererFactory->create()->render('pages/error/404.html.twig', [
            'route' => $this->route->getUri()
        ]);
        return new Response(200, $content);
    }

    /**
     * @return Response
     */
    public function post(): Response
    {
        return new Response(405);
    }
}
