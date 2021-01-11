<?php

namespace App\Core\Domain\Model\Entity;

class Provinsi
{
    private int $id;
    private int $kodeProvinsi;
    private string $nama;

    /**
     * Provinsi constructor.
     * @param int $id
     * @param int $kodeProvinsi
     * @param string $nama
     */
    public function __construct(int $id, int $kodeProvinsi, string $nama)
    {
        $this->id = $id;
        $this->kodeProvinsi = $kodeProvinsi;
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
}
