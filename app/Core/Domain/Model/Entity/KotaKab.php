<?php

namespace App\Core\Domain\Model\Entity;

class KotaKab
{
    private int $id;
    private int $kodeKota;
    private string $nama;
    private ?Provinsi $provinsi;

    /**
     * KotaKab constructor.
     * @param int $id
     * @param int $kodeKota
     * @param string $nama
     * @param Provinsi|null $provinsi
     */
    public function __construct(int $id, int $kodeKota, string $nama, ?Provinsi $provinsi = null)
    {
        $this->id = $id;
        $this->kodeKota = $kodeKota;
        $this->nama = $nama;
        $this->provinsi = $provinsi;
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
     * @return Provinsi|null
     */
    public function getProvinsi(): ?Provinsi
    {
        return $this->provinsi;
    }

    /**
     * @param Provinsi|null $provinsi
     */
    public function setProvinsi(?Provinsi $provinsi): void
    {
        $this->provinsi = $provinsi;
    }
}
