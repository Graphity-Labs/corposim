<?php declare(strict_types=1);

namespace App\Core;

class Request
{
    /**
     * @var array
     */
    private array $request;

    /**
     * @var string
     */
    private string $serverName;

    /**
     * @var string
     */
    private string $requestUri;

    /**
     * @var string
     */
    private string $method;

    /**
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
        $this->serverName = $_SERVER['SERVER_NAME'];
        $this->requestUri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return array
     */
    public function getRawRequest(): array
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? 'https' : 'http';
    }

    /**
     * @return string
     */
    public function getServerName(): string
    {
        return $this->serverName;
    }

    /**
     * @return string
     */
    public function getRequestUri(): string
    {
        return $this->requestUri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array|null
     */
    public function getAllPostData(): ?array
    {
        return $_POST;
    }

    /**
     * @return array|null
     */
    public function getQueryParameters(): ?array
    {
        return $_GET;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getPostData(string $name): ?string
    {
        if (!isset($_POST[$name]) && empty($_POST[$name])) {
            return null;
        }

        return htmlspecialchars($_POST[$name]);
    }

    /**
     * @param $name
     * @return string|null
     */
    public function getQueryParameter($name): ?string
    {
        return htmlspecialchars($_GET[$name]);
    }
}