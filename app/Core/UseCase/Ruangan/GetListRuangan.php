<?php


namespace App\Core\UseCase\Ruangan;


use App\Core\Domain\Exception\UserNotAllowedException;
use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\User;
use App\Core\Domain\Model\Entity\UserAdmin;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Repository\RuanganRepository;

class GetListRuangan
{
    private RuanganRepository $ruanganRepo;

    /**
     * GetListRuangan constructor.
     * @param RuanganRepository $ruanganRepo
     */
    public function __construct(RuanganRepository $ruanganRepo)
    {
        $this->ruanganRepo = $ruanganRepo;
    }

    /**
     * @param User|null $user
     * @return Ruangan[]
     */
    public function execute(?User $user): array
    {
        if ($user instanceof UserPenyedia) {
            return $this->ruanganRepo->getByPenyedia($user);
        } else {
            return $this->ruanganRepo->getAll();
        }
    }
}
