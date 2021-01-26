<?php


namespace App\Core\UseCase\Dashboard;


use App\Core\Domain\Model\Entity\User;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Repository\ReservasiRepository;
use App\Core\UseCase\Reservasi\GetListReservasi;
use App\Core\UseCase\Ruangan\GetListRuangan;

class CountReservasi
{
    private GetListReservasi $getListReservasi;
    private GetListRuangan $getListRuangan;
    private ReservasiRepository $reservasiRepository;

    /**
     * CountReservasi constructor.
     * @param GetListReservasi $getListReservasi
     * @param GetListRuangan $getListRuangan
     * @param ReservasiRepository $reservasiRepository
     */
    public function __construct(
        GetListReservasi $getListReservasi,
        GetListRuangan $getListRuangan,
        ReservasiRepository $reservasiRepository
    ) {
        $this->getListReservasi = $getListReservasi;
        $this->getListRuangan = $getListRuangan;
        $this->reservasiRepository = $reservasiRepository;
    }

    public function execute(User $user): int
    {
        if (!($user instanceof UserPenyedia)) {
            return count($this->getListReservasi->execute($user));
        }

        $listRuangan = $this->getListRuangan->execute($user);
        $listReservasi = [];

        foreach ($listRuangan as $ruangan) {
            foreach ($this->reservasiRepository->getByRuangan($ruangan) as $reservasi) {
                $listReservasi[] = $reservasi;
            }
        }

        return count($listReservasi);
    }
}
