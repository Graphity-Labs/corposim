<?php declare(strict_types=1);

namespace App\Controller;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class NotFoundController extends BaseController implements ControllerInterface
{
    /**
     * @var string
     */
    private string $environment;

    /**
     * @var ServerRequestInterface
     */
    private ServerRequestInterface $request;

    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $responseFactory;

    /**
     * @var Environment
     */
    private Environment $renderer;

    /**
     * @var string
     */
    private string $template;

    /**
     * @param string $environment
     * @param ServerRequestInterface $request
     * @param ResponseFactoryInterface $responseFactory
     * @param Environment $renderer
     * @param string $template
     */
    public function __construct(
        string $environment,
        ServerRequestInterface $request,
        ResponseFactoryInterface $responseFactory,
        Environment $renderer,
        string $template
    ) {
        $this->environment = $environment;
        $this->request = $request;
        $this->responseFactory = $responseFactory;
        $this->renderer = $renderer;
        $this->template = $template;
    }

    /**
     * @return ResponseInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function get(): ResponseInterface
    {
        $content = $this->renderer->render('pages/error/404.html.twig');

        $responseBody = $this->responseFactory->createStream($content);

        return $this->responseFactory->createResponse(404)->withBody($responseBody);
    }

    /**
     * @return ResponseInterface
     */
    public function post(): ResponseInterface
    {
        $responseFactory = new Psr17Factory();

        return $responseFactory->createResponse(405);
    }
}
