<?php


namespace App\Core\Domain\Exception;


use Exception;
use Throwable;

class EntityInvalidAttributeException extends Exception
{
    public function __construct($message = "invalid entity attribute exception", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
