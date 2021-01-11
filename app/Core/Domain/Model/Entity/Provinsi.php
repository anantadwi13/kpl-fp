<?php

namespace App\Core\Domain\Model\Entity;

class Provinsi
{
    private int $id;
    private int $kodeProvinsi;
    private string $nama;
    /* @var KotaKab[] */
    private array $kotaKab;

    /**
     * Provinsi constructor.
     * @param int $id
     * @param int $kodeProvinsi
     * @param string $nama
     * @param KotaKab[] $kotaKab
     */
    public function __construct(int $id, int $kodeProvinsi, string $nama, array $kotaKab)
    {
        $this->id = $id;
        $this->kodeProvinsi = $kodeProvinsi;
        $this->nama = $nama;
        $this->kotaKab = $kotaKab;
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
    public function getKodeProvinsi(): int
    {
        return $this->kodeProvinsi;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @return KotaKab[]
     */
    public function getKotaKab(): array
    {
        return $this->kotaKab;
    }
}
