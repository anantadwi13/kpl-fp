<?php


namespace App\Core\Domain\Repository;


use App\Core\Domain\Model\Entity\Kecamatan;
use App\Core\Domain\Model\Entity\KotaKab;
use App\Core\Domain\Model\Entity\Provinsi;
use App\Core\Domain\Model\ValueObject\Id;

interface WilayahRepository
{
    /**
     * @return Kecamatan[]
     */
    public function getAllKecamatan(): array;

    /**
     * @return KotaKab[]
     */
    public function getAllKotaKab(): array;

    /**
     * @return Provinsi[]
     */
    public function getAllProvinsi(): array;

    /**
     * @param KotaKab $kotaKab
     * @return Kecamatan[]
     */
    public function getKecamatanByKotaKab(KotaKab $kotaKab): array;

    /**
     * @param Provinsi $provinsi
     * @return KotaKab[]
     */
    public function getKotaKabByProvinsi(Provinsi $provinsi): array;

    /**
     * @param Id $id
     * @return Kecamatan|null
     */
    public function getKecamatanById(Id $id): ?Kecamatan;

    /**
     * @param Id $id
     * @return KotaKab|null
     */
    public function getKotaKabById(Id $id): ?KotaKab;

    /**
     * @param Id $id
     * @return Provinsi|null
     */
    public function getProvinsiById(Id $id): ?Provinsi;
}
