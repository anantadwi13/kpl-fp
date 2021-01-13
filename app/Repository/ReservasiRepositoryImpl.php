<?php


namespace App\Repository;


use App\Core\Domain\Model\Entity\Reservasi;
use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserPeminjam;
use App\Core\Domain\Repository\ReservasiRepository;
use App\Transformer\ReservasiTransformer;

class ReservasiRepositoryImpl implements ReservasiRepository
{
    private ReservasiTransformer $reservasiTransformer;

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $allReservasi = \App\Reservasi::all();
        $listReservasi = [];

        foreach ($allReservasi as $reservasi) {
            $listReservasi[] = $this->reservasiTransformer->fromEloquent($reservasi);
        }

        return $listReservasi;
    }

    /**
     * @inheritDoc
     */
    public function getByRuangan(Ruangan $ruangan): array
    {
        $allReservasi = \App\Reservasi::whereIdRuangan($ruangan->getId()->getValue())->get();
        $listReservasi = [];

        foreach ($allReservasi as $reservasi) {
            $listReservasi[] = $this->reservasiTransformer->fromEloquent($reservasi);
        }

        return $listReservasi;
    }

    /**
     * @inheritDoc
     */
    public function getByPeminjam(UserPeminjam $peminjam): array
    {
        $allReservasi = \App\Reservasi::whereIdUser($peminjam->getId()->getValue())->get();
        $listReservasi = [];

        foreach ($allReservasi as $reservasi) {
            $listReservasi[] = $this->reservasiTransformer->fromEloquent($reservasi);
        }

        return $listReservasi;
    }
}
