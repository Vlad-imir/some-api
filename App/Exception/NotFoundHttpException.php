<?php

namespace App\Exception;

/**
 * Class NotFoundHttpException
 */
class NotFoundHttpException extends HttpException
{
    /**
     * NotFoundHttpException constructor.
     * @param string $message
     */
    public function __construct($message = 'Record not found')
    {
        parent::__construct($message, 404);
    }
}