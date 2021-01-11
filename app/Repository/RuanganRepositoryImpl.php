<?php


namespace App\Repository;


use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Repository\RuanganRepository;
use App\Transformer\RuanganTransformer;

class RuanganRepositoryImpl implements RuanganRepository
{
    private RuanganTransformer $ruanganTransformer;

    /**
     * RuanganRepositoryImpl constructor.
     * @param RuanganTransformer $ruanganTransformer
     */
    public function __construct(RuanganTransformer $ruanganTransformer)
    {
        $this->ruanganTransformer = $ruanganTransformer;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $allRuangan = \App\Ruangan::all();
        $listRuangan = [];

        foreach ($allRuangan as $ruangan) {
            $listRuangan[] = $this->ruanganTransformer->fromEloquent($ruangan);
        }

        return $listRuangan;
    }


    /**
     * @inheritDoc
     */
    public function getByPenyedia(UserPenyedia $penyedia): array
    {
        $allRuangan = \App\Ruangan::whereIdUser($penyedia->getId());
        $listRuangan = [];

        foreach ($allRuangan as $ruangan) {
            $listRuangan[] = $this->ruanganTransformer->fromEloquent($ruangan);
        }

        return $listRuangan;
    }
}
