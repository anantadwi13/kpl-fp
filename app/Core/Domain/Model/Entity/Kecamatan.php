<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Model\ValueObject\Id;

class Kecamatan
{
    private Id $id;
    private int $kodeKecamatan;
    private string $nama;
    private ?KotaKab $kotaKab;

    /**
     * Kecamatan constructor.
     * @param Id $id
     * @param int $kodeKecamatan
     * @param string $nama
     * @param KotaKab|null $kotaKab
     */
    public function __construct(Id $id, int $kodeKecamatan, string $nama, ?KotaKab $kotaKab = null)
    {
        $this->id = $id;
        $this->kodeKecamatan = $kodeKecamatan;
        $this->nama = $nama;
        $this->kotaKab = $kotaKab;
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
