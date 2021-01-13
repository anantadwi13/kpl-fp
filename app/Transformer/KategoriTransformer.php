<?php


namespace App\Transformer;


use App\Core\Domain\Model\Entity\Kategori;
use App\Core\Domain\Model\ValueObject\Id;

class KategoriTransformer
{
    public function fromEloquent(\App\Kategori $el): Kategori
    {
        return new Kategori(new Id($el->id), $el->nama);
    }

    public function toEloquent(Kategori $data): \App\Kategori
    {
        $el = new \App\Kategori();
        $el->id = $data->getId()->getValue();
        $el->nama = $data->getNama();

        return $el;
    }
}
