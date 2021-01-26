<?php


namespace App\Core\Domain\Model\Entity;


use App\Core\Domain\Model\ValueObject\Id;

class Kategori
{
    private Id $id;
    private string $nama;

    /**
     * Kategori constructor.
     * @param Id $id
     * @param string $nama
     */
    public function __construct(Id $id, string $nama)
    {
        $this->id = $id;
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
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }
}
