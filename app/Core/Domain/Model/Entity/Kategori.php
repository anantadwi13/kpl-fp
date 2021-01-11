<?php


namespace App\Core\Domain\Model\Entity;


class Kategori
{
    private int $id;
    private string $nama;

    /**
     * Kategori constructor.
     * @param int $id
     * @param string $nama
     */
    public function __construct(int $id, string $nama)
    {
        $this->id = $id;
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
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }
}
