<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Exception\EntityInvalidAttributeException;
use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Model\ValueObject\RuanganStatus;

class Ruangan
{
    private Id $id;
    private ?string $kode;
    private string $nama;
    private UserPenyedia $penyedia;
    private ?Alamat $alamat;
    private RuanganStatus $status;
    private Kategori $kategori;

    /**
     * Ruangan constructor.
     * @param Id $id
     * @param string|null $nama
     * @param UserPenyedia|null $penyedia
     * @param RuanganStatus|null $status
     * @param Kategori|null $kategori
     * @param string|null $kode
     * @param Alamat|null $alamat
     * @throws EntityInvalidAttributeException
     */
    public function __construct(
        Id $id,
        ?string $nama,
        ?UserPenyedia $penyedia,
        ?RuanganStatus $status,
        ?Kategori $kategori,
        ?string $kode = null,
        ?Alamat $alamat = null
    ) {
        $this->id = $id;
        $this->setKode($kode);
        $this->setNama($nama);
        $this->setPenyedia($penyedia);
        $this->setAlamat($alamat);
        $this->setStatus($status);
        $this->setKategori($kategori);
    }

    /**
     * @param string|null $kode
     */
    public function setKode(?string $kode): void
    {
        $this->kode = $kode;
    }

    /**
     * @param string|null $nama
     * @throws EntityInvalidAttributeException
     */
    public function setNama(?string $nama): void
    {
        if (is_null($nama)) {
            throw new EntityInvalidAttributeException();
        }
        $this->nama = $nama;
    }

    /**
     * @param UserPenyedia|null $penyedia
     * @throws EntityInvalidAttributeException
     */
    public function setPenyedia(?UserPenyedia $penyedia): void
    {
        if (is_null($penyedia)) {
            throw new EntityInvalidAttributeException();
        }
        $this->penyedia = $penyedia;
    }

    /**
     * @param Alamat|null $alamat
     */
    public function setAlamat(?Alamat $alamat): void
    {
        $this->alamat = $alamat;
    }

    /**
     * @param RuanganStatus|null $status
     * @throws EntityInvalidAttributeException
     */
    public function setStatus(?RuanganStatus $status): void
    {
        if (is_null($status)) {
            throw new EntityInvalidAttributeException();
        }
        $this->status = $status;
    }

    /**
     * @param Kategori|null $kategori
     * @throws EntityInvalidAttributeException
     */
    public function setKategori(?Kategori $kategori): void
    {
        if (is_null($kategori)) {
            throw new EntityInvalidAttributeException();
        }
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
     * @return string|null
     */
    public function getKode(): ?string
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
     * @return Alamat|null
     */
    public function getAlamat(): ?Alamat
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
