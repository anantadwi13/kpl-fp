<?php


namespace App\Core\UseCase\Wilayah;


use App\Core\Domain\Model\Entity\Kecamatan;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\WilayahRepository;

class GetListKecamatan
{
    private WilayahRepository $wilayahRepository;

    /**
     * GetListKecamatan constructor.
     * @param WilayahRepository $wilayahRepository
     */
    public function __construct(WilayahRepository $wilayahRepository)
    {
        $this->wilayahRepository = $wilayahRepository;
    }

    /**
     * @param int|null $kotaKabId
     * @return Kecamatan[]
     */
    public function execute(?int $kotaKabId = null): array
    {
        if ($kotaKabId !== null) {
            $kotaKab = $this->wilayahRepository->getKotaKabById(new Id($kotaKabId));
            return $this->wilayahRepository->getKecamatanByKotaKab($kotaKab);
        }
        return $this->wilayahRepository->getAllKecamatan();
    }
}
