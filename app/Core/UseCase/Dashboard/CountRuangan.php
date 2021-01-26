<?php


namespace App\Core\UseCase\Dashboard;


use App\Core\Domain\Exception\UserNotAllowedException;
use App\Core\Domain\Model\Entity\User;
use App\Core\UseCase\Ruangan\GetListRuangan;

class CountRuangan
{
    private GetListRuangan $getListRuangan;

    /**
     * CountRuangan constructor.
     * @param GetListRuangan $getListRuangan
     */
    public function __construct(GetListRuangan $getListRuangan)
    {
        $this->getListRuangan = $getListRuangan;
    }

    /**
     * @param User|null $user
     * @return int
     */
    public function execute(?User $user): int
    {
        return count($this->getListRuangan->execute($user));
    }
}
