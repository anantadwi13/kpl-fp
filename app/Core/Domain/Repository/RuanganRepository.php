<?php


namespace App\Core\Domain\Repository;


use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserPenyedia;

interface RuanganRepository
{
    /**
     * @return Ruangan[]
     */
    public function getAll(): array;

    /**
     * @param UserPenyedia $penyedia
     * @return Ruangan[]
     */
    public function getByPenyedia(UserPenyedia $penyedia): array;
}
