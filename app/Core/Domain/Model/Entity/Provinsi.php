<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Model\ValueObject\Id;

class Provinsi
{
    private Id $id;
    private int $kodeProvinsi;
    private string $nama;

    /**
     * Provinsi constructor.
     * @param Id $id
     * @param int $kodeProvinsi
     * @param string $nama
     */
    public function __construct(Id $id, int $kodeProvinsi, string $nama)
    {
        $this->id = $id;
        $this->kodeProvinsi = $kodeProvinsi;
        $this->nama = $nama;
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
