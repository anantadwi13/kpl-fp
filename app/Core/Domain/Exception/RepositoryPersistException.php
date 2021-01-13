<?php


namespace App\Core\Domain\Exception;


class RepositoryPersistException extends RepositoryException
{
    public function __construct($message = "repository persist exception")
    {
        parent::__construct($message);
    }
}
