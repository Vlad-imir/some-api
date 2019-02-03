<?php

namespace App\Exception;

/**
 * Class BadRequestHttpException
 */
class BadRequestHttpException extends HttpException
{
    /**
     * BadRequestHttpException constructor.
     * @param string $message
     */
    public function __construct($message = 'Bad request')
    {
        parent::__construct($message, 400);
    }
}