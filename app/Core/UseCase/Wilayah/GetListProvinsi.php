<?php


namespace App\Core\UseCase\Wilayah;


use App\Core\Domain\Model\Entity\Provinsi;
use App\Core\Domain\Repository\WilayahRepository;

class GetListProvinsi
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
     * @return Provinsi[]
     */
    public function execute(): array
    {
        return $this->wilayahRepository->getAllProvinsi();
    }
}
