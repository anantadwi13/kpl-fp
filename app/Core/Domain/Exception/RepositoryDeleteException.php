<?php


namespace App\Core\Domain\Exception;


class RepositoryDeleteException extends RepositoryException
{
    public function __construct($message = "repository delete exception")
    {
        parent::__construct($message);
    }
}
