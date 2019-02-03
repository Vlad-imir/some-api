<?php

namespace App;

/**
 * Class Request
 */
class Request
{
    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var
     */
    private $method;

    /**
     * @var
     */
    private $uri;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->initHeaders();
        $this->initMethod();
        $this->initUri();
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getHeader($name)
    {
        return $this->headers['name'];
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return file_get_contents('php://input');
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     *
     */
    private function initHeaders()
    {
        foreach ($_SERVER as $name => $value) {
            if (strncmp($name, 'HTTP_', 5) === 0) {
                $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                $this->headers[$key] = $value;
            }
        }
    }

    /**
     *
     */
    private function initMethod()
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $this->method = $method;
    }

    /**
     *
     */
    private function initUri()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
    }
}