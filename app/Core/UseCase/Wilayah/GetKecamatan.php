<?php


namespace App\Core\UseCase\Wilayah;


use App\Core\Domain\Model\Entity\Kecamatan;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\WilayahRepository;

class GetKecamatan
{
    private WilayahRepository $wilayahRepository;

    public function __construct(WilayahRepository $wilayahRepository)
    {
        $this->wilayahRepository = $wilayahRepository;
    }

    public function execute(int $id): ?Kecamatan
    {
        return $this->wilayahRepository->getKecamatanById(new Id($id));
    }
}
