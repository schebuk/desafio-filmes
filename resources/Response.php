<?php

declare(strict_types=1);

namespace Resources;

class Response
{
    private int $httpCode = 200;
    private array $headers = [];
    private string $contentType = 'text/html';
    private string $content;

    private function sendHeaders(): void
    {
        http_response_code($this->httpCode);
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    public function __construct(int $httpCode, string $content, string $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContenType($contentType);
    }

    public function setContenType(string $contentType): void
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    public function sendResponse(): void
    {
        $this->sendHeaders();
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit();
        }
    }
}
