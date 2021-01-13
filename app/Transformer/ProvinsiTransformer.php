<?php


namespace App\Transformer;


use App\Core\Domain\Model\Entity\Provinsi;
use App\Core\Domain\Model\ValueObject\Id;

class ProvinsiTransformer
{

    public function fromEloquent(\App\Provinsi $el): Provinsi
    {
        return new Provinsi(
            new Id($el->id),
            $el->id,
            $el->nama
        );
    }

    public function toEloquent(Provinsi $data): \App\Provinsi
    {
        $el = new \App\Provinsi();
        $el->id = $data->getId()->getValue();
        $el->nama = $data->getNama();
        return $el;
    }
}
