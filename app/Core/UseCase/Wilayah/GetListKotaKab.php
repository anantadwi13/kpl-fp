<?php


namespace App\Core\UseCase\Wilayah;


use App\Core\Domain\Model\Entity\KotaKab;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\WilayahRepository;

class GetListKotaKab
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
     * @param int|null $provinsiId
     * @return KotaKab[]
     */
    public function execute(?int $provinsiId = null): array
    {
        if ($provinsiId !== null) {
            $provinsi = $this->wilayahRepository->getProvinsiById(new Id($provinsiId));
            return $this->wilayahRepository->getKotaKabByProvinsi($provinsi);
        }
        return $this->wilayahRepository->getAllKotaKab();
    }
}
