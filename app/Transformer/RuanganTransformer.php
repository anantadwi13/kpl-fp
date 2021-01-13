<?php


namespace App\Transformer;


use App\Core\Domain\Exception\UserNotAllowedException;
use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Model\ValueObject\RuanganStatus;

class RuanganTransformer
{
    private UserTransformer $userTransformer;
    private KecamatanTransformer $kecamatanTransformer;
    private KotaKabTransformer $kotaKabTransformer;
    private ProvinsiTransformer $provinsiTransformer;
    private KategoriTransformer $kategoriTransformer;

    /**
     * RuanganTransformer constructor.
     * @param UserTransformer $userTransformer
     * @param KecamatanTransformer $kecamatanTransformer
     * @param KotaKabTransformer $kotaKabTransformer
     * @param ProvinsiTransformer $provinsiTransformer
     * @param KategoriTransformer $kategoriTransformer
     */
    public function __construct(
        UserTransformer $userTransformer,
        KecamatanTransformer $kecamatanTransformer,
        KotaKabTransformer $kotaKabTransformer,
        ProvinsiTransformer $provinsiTransformer,
        KategoriTransformer $kategoriTransformer
    ) {
        $this->userTransformer = $userTransformer;
        $this->kecamatanTransformer = $kecamatanTransformer;
        $this->kotaKabTransformer = $kotaKabTransformer;
        $this->provinsiTransformer = $provinsiTransformer;
        $this->kategoriTransformer = $kategoriTransformer;
    }

    public function fromEloquent(\App\Ruangan $el): Ruangan
    {
        $penyedia = $this->userTransformer->fromEloquent($el->user);

        if (!($penyedia instanceof UserPenyedia)) {
            throw new UserNotAllowedException();
        }

        $alamat = new Alamat(
            $el->alamat_jalan,
            $this->kecamatanTransformer->fromEloquent($el->kecamatan),
            $this->kotaKabTransformer->fromEloquent($el->kecamatan->kotakab),
            $this->provinsiTransformer->fromEloquent($el->kecamatan->kotakab->provinsi),
        );

        switch ($el->status) {
            case \App\Ruangan::STATUS_MAINTENANCE:
                $status = RuanganStatus::MAINTENANCE();
                break;
            default:
                $status = RuanganStatus::AVAILABLE();
        }

        return new Ruangan(
            new Id($el->id),
            $el->kode,
            $el->nama,
            $penyedia,
            $alamat,
            $status,
            $this->kategoriTransformer->fromEloquent($el->kategori)
        );
    }

    public function toEloquent(Ruangan $data): \App\Ruangan
    {
        $el = new \App\Ruangan();
        $el->id = $data->getId()->getValue();
        $el->kode = $data->getKode();
        $el->nama = $data->getNama();
        $el->id_user = $data->getPenyedia()->getId()->getValue();
        $el->alamat_jalan = $data->getAlamat()->getJalan();
        $el->alamat_kecamatan = $data->getAlamat()->getKecamatan()->getId()->getValue();
        $el->id_kategori = $data->getKategori()->getId()->getValue();

        switch ($data->getStatus()->getValue()) {
            case RuanganStatus::MAINTENANCE()->getValue():
                $el->status = \App\Ruangan::STATUS_MAINTENANCE;
                break;
            default:
                $el->status = \App\Ruangan::STATUS_AVAILABLE;
        }

        return $el;
    }
}
