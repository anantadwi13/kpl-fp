<?php


namespace App\Core\UseCase\Dashboard;


use App\Core\UseCase\Kategori\GetListKategori;

class CountKategori
{
    private GetListKategori $getListKategori;

    /**
     * CountKategori constructor.
     * @param GetListKategori $getListKategori
     */
    public function __construct(GetListKategori $getListKategori)
    {
        $this->getListKategori = $getListKategori;
    }

    public function execute(): int
    {
        return count($this->getListKategori->execute());
    }
}
