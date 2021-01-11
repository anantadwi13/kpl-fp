<?php

namespace App\Core\Domain\Model\Entity;

class Kecamatan
{
    private int $id;
    private int $kodeKecamatan;
    private string $nama;
    private ?KotaKab $kotaKab;

    /**
     * Kecamatan constructor.
     * @param int $id
     * @param int $kodeKecamatan
     * @param string $nama
     * @param KotaKab|null $kotaKab
     */
    public function __construct(int $id, int $kodeKecamatan, string $nama, ?KotaKab $kotaKab = null)
    {
        $this->id = $id;
        $this->kodeKecamatan = $kodeKecamatan;
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
    public function getKodeKecamatan(): int
    {
        return $this->kodeKecamatan;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @return KotaKab|null
     */
    public function getKotaKab(): ?KotaKab
    {
        return $this->kotaKab;
    }

    /**
     * @param KotaKab|null $kotaKab
     */
    public function setKotaKab(?KotaKab $kotaKab): void
    {
        $this->kotaKab = $kotaKab;
    }
}
