<?php


namespace App\Transformer;


use App\Core\Domain\Exception\UserNotAllowedException;
use App\Core\Domain\Model\Entity\Reservasi;
use App\Core\Domain\Model\Entity\UserPeminjam;
use App\Core\Domain\Model\ValueObject\Acara;
use App\Core\Domain\Model\ValueObject\ReservasiStatus;

class ReservasiTransformer
{
    private RuanganTransformer $ruanganTransformer;
    private UserTransformer $userTransformer;

    /**
     * ReservasiTransformer constructor.
     * @param RuanganTransformer $ruanganTransformer
     * @param UserTransformer $userTransformer
     */
    public function __construct(RuanganTransformer $ruanganTransformer, UserTransformer $userTransformer)
    {
        $this->ruanganTransformer = $ruanganTransformer;
        $this->userTransformer = $userTransformer;
    }

    public function fromEloquent(\App\Reservasi $el): Reservasi
    {
        $peminjam = $this->userTransformer->fromEloquent($el->user);

        if (!($peminjam instanceof UserPeminjam)) {
            throw new UserNotAllowedException();
        }

        $acara = new Acara($el->nama_acara, $el->deskripsi_acara);

        switch ($el->status) {
            case \App\Reservasi::STATUS_ACCEPTED:
                $status = ReservasiStatus::ACCEPTED();
                break;
            case \App\Reservasi::STATUS_REJECTED:
                $status = ReservasiStatus::REJECTED();
                break;
            default:
                $status = ReservasiStatus::WAITING();
        }

        return new Reservasi(
            $el->id,
            $this->ruanganTransformer->fromEloquent($el->ruangan),
            $peminjam,
            $acara,
            new \DateTime($el->time_start),
            new \DateTime($el->time_end),
            $status
        );
    }

    public function toEloquent(Reservasi $data): \App\Reservasi
    {
        $el = new \App\Reservasi();
        $el->id = $data->getId();
        $el->id_ruangan = $data->getRuangan()->getId();
        $el->id_user = $data->getPeminjam()->getId();
        $el->nama_acara = $data->getAcara()->getNama();
        $el->deskripsi_acara = $data->getAcara()->getDeskripsi();
        $el->time_start = $data->getMulai()->format("Y-m-d H:i:s");
        $el->time_end = $data->getSelesai()->format("Y-m-d H:i:s");

        switch ($data->getStatus()->getValue()) {
            case ReservasiStatus::ACCEPTED()->getValue():
                $el->status = \App\Reservasi::STATUS_ACCEPTED;
                break;
            case ReservasiStatus::REJECTED()->getValue():
                $el->status = \App\Reservasi::STATUS_REJECTED;
                break;
            default:
                $el->status = \App\Reservasi::STATUS_WAITING;
        }

        return $el;
    }
}
