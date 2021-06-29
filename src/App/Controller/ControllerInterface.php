<?php declare(strict_types=1);

namespace App\Controller;

use Twig\Environment;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;

interface ControllerInterface
{
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
    );

    /**
     * @return ResponseInterface
     */
    public function get(): ResponseInterface;

    /**
     * @return ResponseInterface
     */
    public function post(): ResponseInterface;
}
