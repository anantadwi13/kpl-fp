<?php

namespace App\Core\Domain\Model\Entity;

class Kecamatan
{
    private int $id;
    private int $kodeKecamatan;
    private string $nama;

    /**
     * Kecamatan constructor.
     * @param int $id
     * @param int $kodeKecamatan
     * @param string $nama
     */
    public function __construct(int $id, int $kodeKecamatan, string $nama)
    {
        $this->id = $id;
        $this->kodeKecamatan = $kodeKecamatan;
        $this->nama = $nama;
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
}
