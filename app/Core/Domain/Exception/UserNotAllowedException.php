<?php


namespace App\Core\Domain\Exception;


use Exception;
use Throwable;

class UserNotAllowedException extends Exception
{
    public function __construct($message = "user not allowed exception", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
