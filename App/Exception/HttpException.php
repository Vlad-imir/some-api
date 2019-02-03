<?php

namespace App\Exception;

/**
 * Class HttpException
 */
abstract class HttpException extends \Exception
{
    /**
     * @var int
     */
    protected $statusCode;

    /**
     * HttpException constructor.
     * @param string $message
     * @param int $statusCode
     * @param \Exception $code
     * @param \Exception $previous
     */
    public function __construct($message, $statusCode, $code = 0, \Exception $previous = null)
    {
        $this->statusCode = $statusCode;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}