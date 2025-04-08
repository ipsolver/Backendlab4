<?php

class Response 
{
    private int $status = 200;
    private array $headers = [];


    public function __construct()
    {
        ob_start();
    }

    public function setStatus(int $code) : void
    {
        $this->status = $code;
        http_response_code($code);
    }

    public function addHeader(string $header): void
    {
        $this->headers[] = $header;
    }

    public function send(string $content): void
    {
        ob_clean();
        foreach ($this->headers as $header) 
        {
            header($header);
        }
        echo $content;
        ob_end_flush();
        exit;
    }
}