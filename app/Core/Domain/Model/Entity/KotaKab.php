<?php

namespace App\Core\Domain\Model\Entity;

class KotaKab
{
    private int $id;
    private int $kodeKota;
    private string $nama;
    /* @var Kecamatan[] */
    private array $kecamatan;

    /**
     * KotaKab constructor.
     * @param int $id
     * @param int $kodeKota
     * @param string $nama
     * @param Kecamatan[] $kecamatan
     */
    public function  __construct(int $id, int $kodeKota, string $nama, array $kecamatan)
    {
        $this->id = $id;
        $this->kodeKota = $kodeKota;
        $this->nama = $nama;
        $this->kecamatan = $kecamatan;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getKodeKota(): int
    {
        return $this->kodeKota;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @return Kecamatan[]
     */
    public function getKecamatan(): array
    {
        return $this->kecamatan;
    }
}
