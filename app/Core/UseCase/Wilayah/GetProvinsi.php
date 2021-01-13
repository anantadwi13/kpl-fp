<?php


namespace App\Core\UseCase\Wilayah;


use App\Core\Domain\Model\Entity\Provinsi;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\WilayahRepository;

class GetProvinsi
{
    private WilayahRepository $wilayahRepository;

    public function __construct(WilayahRepository $wilayahRepository)
    {
        $this->wilayahRepository = $wilayahRepository;
    }

    public function execute(int $id): ?Provinsi
    {
        return $this->wilayahRepository->getProvinsiById(new Id($id));
    }
}
