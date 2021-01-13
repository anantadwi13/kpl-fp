<?php


namespace App\Core\UseCase\Ruangan;


use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Repository\RuanganRepository;

class DeleteRuangan
{
    private RuanganRepository $ruanganRepo;

    /**
     * DeleteRuangan constructor.
     * @param RuanganRepository $ruanganRepo
     */
    public function __construct(RuanganRepository $ruanganRepo)
    {
        $this->ruanganRepo = $ruanganRepo;
    }

    /**
     * @param Ruangan $ruangan
     * @return void
     * @throws \App\Core\Domain\Exception\RepositoryDeleteException
     */
    public function execute(Ruangan $ruangan): void
    {
        $this->ruanganRepo->delete($ruangan);
    }
}
