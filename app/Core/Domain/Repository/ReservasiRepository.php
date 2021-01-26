<?php


namespace App\Core\Domain\Repository;


use App\Core\Domain\Model\Entity\Reservasi;
use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserPeminjam;

interface ReservasiRepository
{
    /**
     * @return Reservasi[]
     */
    public function getAll(): array;

    /**
     * @param Ruangan $ruangan
     * @return Reservasi[]
     */
    public function getByRuangan(Ruangan $ruangan): array;

    /**
     * @param UserPeminjam $peminjam
     * @return Reservasi[]
     */
    public function getByPeminjam(UserPeminjam $peminjam): array;
}
