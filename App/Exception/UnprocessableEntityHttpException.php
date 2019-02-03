<?php

namespace App\Exception;

/**
 * Class UnprocessableEntityHttpException
 */
class UnprocessableEntityHttpException extends HttpException
{
    /**
     * UnprocessableEntityHttpException constructor.
     * @param string $message
     */
    public function __construct($message = 'Unprocessable Entity exception')
    {
        parent::__construct($message, 422);
    }
}