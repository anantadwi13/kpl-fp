<?php


namespace App\Repository;


use App\Core\Domain\Model\Entity\Kecamatan;
use App\Core\Domain\Model\Entity\KotaKab;
use App\Core\Domain\Model\Entity\Provinsi;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\WilayahRepository;
use App\Transformer\KecamatanTransformer;
use App\Transformer\KotaKabTransformer;
use App\Transformer\ProvinsiTransformer;

class WilayahRepositoryImpl implements WilayahRepository
{
    private ProvinsiTransformer $provinsiTransformer;
    private KotaKabTransformer $kotaKabTransformer;
    private KecamatanTransformer $kecamatanTransformer;

    /**
     * WilayahRepositoryImpl constructor.
     * @param ProvinsiTransformer $provinsiTransformer
     * @param KotaKabTransformer $kotaKabTransformer
     * @param KecamatanTransformer $kecamatanTransformer
     */
    public function __construct(
        ProvinsiTransformer $provinsiTransformer,
        KotaKabTransformer $kotaKabTransformer,
        KecamatanTransformer $kecamatanTransformer
    ) {
        $this->provinsiTransformer = $provinsiTransformer;
        $this->kotaKabTransformer = $kotaKabTransformer;
        $this->kecamatanTransformer = $kecamatanTransformer;
    }

    public function getAllKecamatan(): array
    {
        $allKecamatan = \App\Kecamatan::all();
        $listKecamatan = [];

        foreach ($allKecamatan as $kecamatan) {
            $listKecamatan[] = $this->kecamatanTransformer->fromEloquent($kecamatan);
        }

        return $listKecamatan;
    }

    public function getAllKotaKab(): array
    {
        $allKotaKab = \App\KotaKab::all();
        $listKotaKab = [];

        foreach ($allKotaKab as $kotaKab) {
            $listKotaKab[] = $this->kotaKabTransformer->fromEloquent($kotaKab);
        }

        return $listKotaKab;
    }

    public function getAllProvinsi(): array
    {
        $allProvinsi = \App\Provinsi::all();
        $listProvinsi = [];

        foreach ($allProvinsi as $provinsi) {
            $listProvinsi[] = $this->provinsiTransformer->fromEloquent($provinsi);
        }

        return $listProvinsi;
    }

    public function getKecamatanByKotaKab(KotaKab $kotaKab): array
    {
        $allKecamatan = \App\Kecamatan::whereIdKota($kotaKab->getId()->getValue())->get();
        $listKecamatan = [];

        foreach ($allKecamatan as $kecamatan) {
            $listKecamatan[] = $this->kecamatanTransformer->fromEloquent($kecamatan);
        }

        return $listKecamatan;
    }

    public function getKotaKabByProvinsi(Provinsi $provinsi): array
    {
        $allKotaKab = \App\KotaKab::whereIdProvinsi($provinsi->getId()->getValue())->get();
        $listKotaKab = [];

        foreach ($allKotaKab as $kotaKab) {
            $listKotaKab[] = $this->kotaKabTransformer->fromEloquent($kotaKab);
        }

        return $listKotaKab;
    }

    public function getKecamatanById(Id $id): ?Kecamatan
    {
        $kecamatan = \App\Kecamatan::whereId($id->getValue())->first();

        if (!$kecamatan) {
            return null;
        }

        return $this->kecamatanTransformer->fromEloquent($kecamatan, true);
    }

    public function getKotaKabById(Id $id): ?KotaKab
    {
        $kotaKab = \App\KotaKab::whereId($id->getValue())->first();

        if (!$kotaKab) {
            return null;
        }

        return $this->kotaKabTransformer->fromEloquent($kotaKab, true);
    }

    public function getProvinsiById(Id $id): ?Provinsi
    {
        $provinsi = \App\Provinsi::whereId($id->getValue())->first();

        if (!$provinsi) {
            return null;
        }

        return $this->provinsiTransformer->fromEloquent($provinsi);
    }
}
