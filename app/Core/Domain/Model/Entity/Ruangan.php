<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Model\ValueObject\RuanganStatus;

class Ruangan
{
    private Id $id;
    private string $kode;
    private string $nama;
    private UserPenyedia $penyedia;
    private Alamat $alamat;
    private RuanganStatus $status;
    private Kategori $kategori;

    /**
     * Ruangan constructor.
     * @param Id $id
     * @param string $kode
     * @param string $nama
     * @param UserPenyedia $penyedia
     * @param Alamat $alamat
     * @param RuanganStatus $status
     * @param Kategori $kategori
     */
    public function __construct(
        Id $id,
        string $kode,
        string $nama,
        UserPenyedia $penyedia,
        Alamat $alamat,
        RuanganStatus $status,
        Kategori $kategori
    ) {
        $this->id = $id;
        $this->kode = $kode;
        $this->nama = $nama;
        $this->penyedia = $penyedia;
        $this->alamat = $alamat;
        $this->status = $status;
        $this->kategori = $kategori;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKode(): string
    {
        return $this->kode;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @return UserPenyedia
     */
    public function getPenyedia(): UserPenyedia
    {
        return $this->penyedia;
    }

    /**
     * @return Alamat
     */
    public function getAlamat(): Alamat
    {
        return $this->alamat;
    }

    /**
     * @return RuanganStatus
     */
    public function getStatus(): RuanganStatus
    {
        return $this->status;
    }

    /**
     * @return Kategori
     */
    public function getKategori(): Kategori
    {
        return $this->kategori;
    }
}
