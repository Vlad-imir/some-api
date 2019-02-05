<?php

namespace App;

/**
 * Class Response
 */
class Response
{
    /**
     * @var
     */
    private $headers = [
        'Content-type: application/json'
    ];

    /**
     * @var
     */
    private $content;

    /**
     * @var
     */
    private $statusCode = 200;

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param $name
     * @param $value
     */
    public function addHeader($value)
    {
        $this->headers[] = $value;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function setStatusCode($code)
    {
        return $this->statusCode = $code;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Send headers and content
     */
    public function send()
    {
        http_response_code($this->getStatusCode());

        foreach ($this->getHeaders() as $header) {
            header($header);
        }

        if ($this->content) {
           echo json_encode($this->content);
        }
    }
}