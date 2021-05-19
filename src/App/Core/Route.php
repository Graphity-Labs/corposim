<?php declare(strict_types=1);

namespace App\Core;

class Route
{
    /**
     * @var string
     */
    private string $uri;

    /**
     * @var array|null
     */
    private ?array $data = null;

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }
}
