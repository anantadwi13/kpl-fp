<?php


namespace App\Core\UseCase\Reservasi;


use App\Core\Domain\Exception\UserNotAllowedException;
use App\Core\Domain\Model\Entity\Reservasi;
use App\Core\Domain\Model\Entity\User;
use App\Core\Domain\Model\Entity\UserAdmin;
use App\Core\Domain\Model\Entity\UserPeminjam;
use App\Core\Domain\Repository\ReservasiRepository;

class GetListReservasi
{
    private ReservasiRepository $reservasiRepository;

    /**
     * GetListReservasi constructor.
     * @param ReservasiRepository $reservasiRepository
     */
    public function __construct(ReservasiRepository $reservasiRepository)
    {
        $this->reservasiRepository = $reservasiRepository;
    }

    /**
     * @param User $user
     * @return Reservasi[]
     * @throws UserNotAllowedException
     */
    public function execute(User $user): array
    {
        if ($user instanceof UserPeminjam) {
            return $this->reservasiRepository->getByPeminjam($user);
        } elseif ($user instanceof UserAdmin) {
            return $this->reservasiRepository->getAll();
        } else {
            throw new UserNotAllowedException();
        }
    }
}
