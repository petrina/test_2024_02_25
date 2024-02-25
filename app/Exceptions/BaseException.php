<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{

    protected function getErrorMessage()
    {
        $message = $this->getMessage();
        $jsonMsg = json_decode($message);
        if (json_last_error() === JSON_ERROR_NONE) {
            $message = $jsonMsg;
        }
        return $message;
    }
}
