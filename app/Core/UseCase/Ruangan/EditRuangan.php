<?php


namespace App\Core\UseCase\Ruangan;


use App\Core\Domain\Exception\RepositoryPersistException;
use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\RuanganStatus;
use App\Core\Domain\Repository\RuanganRepository;
use App\Core\UseCase\Kategori\GetKategori;
use App\Core\UseCase\Wilayah\GetKecamatan;
use App\Core\UseCase\Wilayah\GetKotaKab;
use App\Core\UseCase\Wilayah\GetProvinsi;

class EditRuangan
{
    private RuanganRepository $ruanganRepo;
    private GetKategori $getKategori;
    private GetKecamatan $getKecamatan;
    private GetKotaKab $getKotaKab;
    private GetProvinsi $getProvinsi;

    /**
     * EntryRuangan constructor.
     * @param RuanganRepository $ruanganRepo
     * @param GetKategori $getKategori
     * @param GetKecamatan $getKecamatan
     * @param GetKotaKab $getKotaKab
     * @param GetProvinsi $getProvinsi
     */
    public function __construct(
        RuanganRepository $ruanganRepo,
        GetKategori $getKategori,
        GetKecamatan $getKecamatan,
        GetKotaKab $getKotaKab,
        GetProvinsi $getProvinsi
    ) {
        $this->ruanganRepo = $ruanganRepo;
        $this->getKategori = $getKategori;
        $this->getKecamatan = $getKecamatan;
        $this->getKotaKab = $getKotaKab;
        $this->getProvinsi = $getProvinsi;
    }

    /**
     * @param EditRuanganParams $params
     * @return void
     * @throws RepositoryPersistException
     * @throws \App\Core\Domain\Exception\EntityInvalidAttributeException
     */
    public function execute(EditRuanganParams $params): void
    {
        $ruangan = $params->latestRuangan;

        if ($params->nama) {
            $ruangan->setNama($params->nama);
        }

        $ruangan->setKode($params->kode);

        if ($params->idKategori !== null && $ruangan->getKategori()->getId()->getValue() !== $params->idKategori) {
            $ruangan->setKategori($this->getKategori->execute($params->idKategori));
        }

        if ($params->alamatJalan && $params->idKecamatan) {
            $kecamatan = $this->getKecamatan->execute($params->idKecamatan);
            $kotaKab = $this->getKotaKab->execute($kecamatan->getKotaKab()->getId()->getValue());
            $provinsi = $this->getProvinsi->execute($kotaKab->getProvinsi()->getId()->getValue());

            $ruangan->setAlamat(new Alamat(
                $params->alamatJalan,
                $kecamatan,
                $kotaKab,
                $provinsi
            ));
        } else {
            $ruangan->setAlamat(null);
        }

        if ($params->status !== null && $params->status === RuanganStatus::AVAILABLE()->getValue()) {
            $ruangan->setStatus(RuanganStatus::AVAILABLE());
        } elseif ($params->status !== null && $params->status === RuanganStatus::MAINTENANCE()->getValue()) {
            $ruangan->setStatus(RuanganStatus::MAINTENANCE());
        }

        $this->ruanganRepo->persist($ruangan);
    }
}
