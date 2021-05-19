<?php declare(strict_types=1);

namespace App\Core;

class Response
{
    /**
     * @var int
     */
    private int $status;

    /**
     * @var string
     */
    private string $htmlContent;

    public function __construct(int $status, string $htmlContent = null)
    {
        $this->status = $status;
        $this->htmlContent = $htmlContent;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getHtmlContent(): string
    {
        return $this->htmlContent;
    }

    public function display(): void
    {
        print($this->htmlContent);
    }
}
