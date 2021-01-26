<?php


namespace App\Repository;


use App\Core\Domain\Model\Entity\Kategori;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\KategoriRepository;
use App\Transformer\KategoriTransformer;

class KategoriRepositoryImpl implements KategoriRepository
{
    private KategoriTransformer $kategoriTransformer;

    /**
     * KategoriRepositoryImpl constructor.
     * @param KategoriTransformer $kategoriTransformer
     */
    public function __construct(KategoriTransformer $kategoriTransformer)
    {
        $this->kategoriTransformer = $kategoriTransformer;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $allKategori = \App\Kategori::all();
        $listKategori = [];

        foreach ($allKategori as $kategori) {
            $listKategori[] = $this->kategoriTransformer->fromEloquent($kategori);
        }

        return $listKategori;
    }

    /**
     * @inheritDoc
     */
    public function getById(Id $id): ?Kategori
    {
        $kategori = \App\Kategori::whereId($id->getValue())->first();

        if (!$kategori) {
            return null;
        }

        return $this->kategoriTransformer->fromEloquent($kategori);
    }
}
