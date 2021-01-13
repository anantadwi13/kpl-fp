<?php


namespace App\Core\Domain\Repository;


use App\Core\Domain\Model\Entity\Kategori;
use App\Core\Domain\Model\ValueObject\Id;

interface KategoriRepository
{
    /**
     * @return Kategori[]
     */
    public function getAll(): array;

    /**
     * @param Id $id
     * @return Kategori|null
     */
    public function getById(Id $id): ?Kategori;
}
