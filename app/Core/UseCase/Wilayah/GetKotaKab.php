<?php


namespace App\Core\UseCase\Wilayah;


use App\Core\Domain\Model\Entity\KotaKab;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\WilayahRepository;

class GetKotaKab
{
    private WilayahRepository $wilayahRepository;

    public function __construct(WilayahRepository $wilayahRepository)
    {
        $this->wilayahRepository = $wilayahRepository;
    }

    public function execute(int $id): ?KotaKab
    {
        return $this->wilayahRepository->getKotaKabById(new Id($id));
    }
}
