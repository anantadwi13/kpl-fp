<?php


namespace App\Core\Domain\Repository;


use App\Core\Domain\Model\Entity\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function getAll(): array;
}
