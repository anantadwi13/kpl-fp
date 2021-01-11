<?php


namespace App\Core\Domain\Exception;


use Exception;
use Throwable;

class UserUnknownException extends Exception
{
    public function __construct($message = "unknown user exception", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
