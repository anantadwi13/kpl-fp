<?php


namespace App\Core\UseCase\Ruangan;


use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\User;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\RuanganRepository;

class GetRuangan
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
     * @param int $id
     * @return Ruangan|null
     */
    public function execute(int $id): ?Ruangan
    {
        return $this->ruanganRepo->getById(new Id($id));
    }
}
