<?php


namespace App\Core\Domain\Exception;


use Exception;
use Throwable;

class RepositoryException extends Exception
{
    public function __construct($message = "repository exception", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
