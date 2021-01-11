<?php


namespace App\Core\Domain\Model\ValueObject;


class Acara
{
    private string $nama;
    private string $deskripsi;

    /**
     * Acara constructor.
     * @param string $nama
     * @param string $deskripsi
     */
    public function __construct(string $nama, string $deskripsi = "")
    {
        $this->nama = $nama;
        $this->deskripsi = $deskripsi;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @return string
     */
    public function getDeskripsi(): string
    {
        return $this->deskripsi;
    }

}
