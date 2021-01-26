<?php


namespace App\Core\UseCase\Kategori;


use App\Core\Domain\Model\Entity\Kategori;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\KategoriRepository;

class GetKategori
{
    private KategoriRepository $kategoriRepository;

    public function __construct(KategoriRepository $kategoriRepository)
    {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function execute(int $id): ?Kategori
    {
        return $this->kategoriRepository->getById(new Id($id));
    }
}
