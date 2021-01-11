<?php


namespace App\Core\UseCase\Dashboard;


use App\Core\UseCase\User\GetListUser;

class CountUser
{
    private GetListUser $getListUser;

    /**
     * CountUser constructor.
     * @param GetListUser $getListUser
     */
    public function __construct(GetListUser $getListUser)
    {
        $this->getListUser = $getListUser;
    }

    public function execute(): int
    {
        return count($this->getListUser->execute());
    }
}
