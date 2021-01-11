<?php


namespace App\Core\UseCase\User;


use App\Core\Domain\Model\Entity\User;
use App\Core\Domain\Repository\UserRepository;

class GetListUser
{
    private UserRepository $userRepository;

    /**
     * GetListUser constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User[]
     */
    public function execute(): array
    {
        return $this->userRepository->getAll();
    }
}
