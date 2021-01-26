<?php


namespace App\Repository;


use App\Core\Domain\Model\Entity\User;
use App\Core\Domain\Repository\UserRepository;
use App\Transformer\UserTransformer;

class UserRepositoryImpl implements UserRepository
{
    private UserTransformer $userTransformer;

    /**
     * UserRepositoryImpl constructor.
     * @param UserTransformer $userTransformer
     */
    public function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $allUser = \App\User::all();
        $listUser = [];

        foreach ($allUser as $user) {
            $listUser[] = $this->userTransformer->fromEloquent($user);
        }

        return $listUser;
    }
}
