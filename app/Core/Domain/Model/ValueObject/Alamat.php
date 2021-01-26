<?php

namespace App\Core\Domain\Model\ValueObject;

use App\Core\Domain\Model\Entity\Kecamatan;
use App\Core\Domain\Model\Entity\KotaKab;
use App\Core\Domain\Model\Entity\Provinsi;

class Alamat
{
    private string $jalan;
    private Kecamatan $kecamatan;
    private KotaKab $kotaKab;
    private Provinsi $provinsi;

    /**
     * Alamat constructor.
     * @param string $jalan
     * @param Kecamatan $kecamatan
     * @param KotaKab $kotaKab
     * @param Provinsi $provinsi
     */
    public function __construct(string $jalan, Kecamatan $kecamatan, KotaKab $kotaKab, Provinsi $provinsi)
    {
        $this->jalan = $jalan;
        $this->kecamatan = $kecamatan;
        $this->kotaKab = $kotaKab;
        $this->provinsi = $provinsi;
    }

    /**
     * @return string
     */
    public function getJalan(): string
    {
        return $this->jalan;
    }

    /**
     * @return Kecamatan
     */
    public function getKecamatan(): Kecamatan
    {
        return $this->kecamatan;
    }

    /**
     * @return KotaKab
     */
    public function getKotaKab(): KotaKab
    {
        return $this->kotaKab;
    }

    /**
     * @return Provinsi
     */
    public function getProvinsi(): Provinsi
    {
        return $this->provinsi;
    }

    public function isEqual(?Alamat $other): bool
    {
        return $other != null
            && $this->getJalan() === $other->getJalan()
            && $this->getKecamatan()->getId()->isEqual($other->getKecamatan()->getId())
            && $this->getKotaKab()->getId()->isEqual($other->getKotaKab()->getId())
            && $this->getProvinsi()->getId()->isEqual($other->getProvinsi()->getId());
    }
}
