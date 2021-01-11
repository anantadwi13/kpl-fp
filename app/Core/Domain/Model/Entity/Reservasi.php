<?php


namespace App\Core\Domain\Model\Entity;


use App\Core\Domain\Model\ValueObject\Acara;
use App\Core\Domain\Model\ValueObject\ReservasiStatus;
use DateTime;

class Reservasi
{
    private int $id;
    private Ruangan $ruangan;
    private UserPeminjam $peminjam;
    private Acara $acara;
    private DateTime $mulai;
    private DateTime $selesai;
    private ReservasiStatus $status;

    /**
     * Reservasi constructor.
     * @param int $id
     * @param Ruangan $ruangan
     * @param UserPeminjam $peminjam
     * @param Acara $acara
     * @param DateTime $mulai
     * @param DateTime $selesai
     * @param ReservasiStatus $status
     */
    public function __construct(
        int $id,
        Ruangan $ruangan,
        UserPeminjam $peminjam,
        Acara $acara,
        DateTime $mulai,
        DateTime $selesai,
        ReservasiStatus $status
    ) {
        $this->id = $id;
        $this->ruangan = $ruangan;
        $this->peminjam = $peminjam;
        $this->acara = $acara;
        $this->mulai = $mulai;
        $this->selesai = $selesai;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Ruangan
     */
    public function getRuangan(): Ruangan
    {
        return $this->ruangan;
    }

    /**
     * @return UserPeminjam
     */
    public function getPeminjam(): UserPeminjam
    {
        return $this->peminjam;
    }

    /**
     * @return Acara
     */
    public function getAcara(): Acara
    {
        return $this->acara;
    }

    /**
     * @return DateTime
     */
    public function getMulai(): DateTime
    {
        return $this->mulai;
    }

    /**
     * @return DateTime
     */
    public function getSelesai(): DateTime
    {
        return $this->selesai;
    }

    /**
     * @return ReservasiStatus
     */
    public function getStatus(): ReservasiStatus
    {
        return $this->status;
    }
}
