<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Model\ValueObject\Id;

class KotaKab
{
    private Id $id;
    private int $kodeKota;
    private string $nama;
    private ?Provinsi $provinsi;

    /**
     * KotaKab constructor.
     * @param Id $id
     * @param int $kodeKota
     * @param string $nama
     * @param Provinsi|null $provinsi
     */
    public function __construct(Id $id, int $kodeKota, string $nama, ?Provinsi $provinsi = null)
    {
        $this->id = $id;
        $this->kodeKota = $kodeKota;
        $this->nama = $nama;
        $this->provinsi = $provinsi;
    }

    /**
     * @return Id
     */
    public function getId(): Id
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
