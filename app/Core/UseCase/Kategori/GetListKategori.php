<?php


namespace App\Core\UseCase\Kategori;


use App\Core\Domain\Repository\KategoriRepository;

class GetListKategori
{
    private KategoriRepository $kategoriRepository;

    /**
     * GetListKategori constructor.
     * @param KategoriRepository $kategoriRepository
     */
    public function __construct(KategoriRepository $kategoriRepository)
    {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function execute(): array
    {
        return $this->kategoriRepository->getAll();
    }
}
