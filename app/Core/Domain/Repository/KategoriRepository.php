<?php


namespace App\Core\Domain\Repository;


use App\Core\Domain\Model\Entity\Kategori;

interface KategoriRepository
{
    /**
     * @return Kategori[]
     */
    public function getAll(): array;
}
