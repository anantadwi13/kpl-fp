<?php


namespace App\Core\UseCase\Ruangan;


use App\Core\Domain\Exception\RepositoryPersistException;
use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Model\ValueObject\RuanganStatus;
use App\Core\Domain\Repository\RuanganRepository;
use App\Core\UseCase\Kategori\GetKategori;
use App\Core\UseCase\Wilayah\GetKecamatan;
use App\Core\UseCase\Wilayah\GetKotaKab;
use App\Core\UseCase\Wilayah\GetProvinsi;

class EntryRuangan
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
     * @param EntryRuanganParams $params
     * @return void
     * @throws RepositoryPersistException
     * @throws \App\Core\Domain\Exception\EntityInvalidAttributeException
     */
    public function execute(EntryRuanganParams $params): void
    {
        $alamat = null;

        if ($params->alamatJalan && $params->idKecamatan) {
            $kecamatan = $this->getKecamatan->execute($params->idKecamatan);
            $kotaKab = $this->getKotaKab->execute($kecamatan->getKotaKab()->getId()->getValue());
            $provinsi = $this->getProvinsi->execute($kotaKab->getProvinsi()->getId()->getValue());

            $alamat = new Alamat(
                $params->alamatJalan,
                $kecamatan,
                $kotaKab,
                $provinsi
            );
        }

        $ruangan = new Ruangan(
            Id::UNSET(),
            $params->nama,
            $params->penyedia,
            RuanganStatus::AVAILABLE(),
            !is_null($params->idKategori) ? $this->getKategori->execute($params->idKategori) : null,
            $params->kode,
            $alamat
        );

        $this->ruanganRepo->persist($ruangan);
    }
}
