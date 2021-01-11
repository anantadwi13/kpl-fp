<?php


namespace App\Transformer;


use App\Core\Domain\Model\Entity\Kategori;

class KategoriTransformer
{
    public function fromEloquent(\App\Kategori $el): Kategori
    {
        return new Kategori($el->id, $el->nama);
    }

    public function toEloquent(Kategori $data): \App\Kategori
    {
        $el = new \App\Kategori();
        $el->id = $data->getId();
        $el->nama = $data->getNama();

        return $el;
    }
}
