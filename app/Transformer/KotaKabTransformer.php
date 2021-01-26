<?php


namespace App\Transformer;


use App\Core\Domain\Model\Entity\KotaKab;
use App\Core\Domain\Model\ValueObject\Id;

class KotaKabTransformer
{
    private ProvinsiTransformer $provinsiTransformer;

    /**
     * KotaKabTransformer constructor.
     * @param ProvinsiTransformer $provinsiTransformer
     */
    public function __construct(ProvinsiTransformer $provinsiTransformer)
    {
        $this->provinsiTransformer = $provinsiTransformer;
    }

    public function fromEloquent(\App\KotaKab $el, bool $parseProvinsi = false): KotaKab
    {
        $provinsi = $parseProvinsi && $el->provinsi ? $this->provinsiTransformer->fromEloquent($el->provinsi) : null;

        return new KotaKab(
            new Id($el->id),
            $el->kode_kota,
            $el->nama,
            $provinsi
        );
    }

    public function toEloquent(KotaKab $data): \App\KotaKab
    {
        $el = new \App\KotaKab();
        $el->id = !$data->getId()->isEqual(Id::UNSET()) ? $data->getId()->getValue() : null;
        $el->nama = $data->getNama();
        $el->id_provinsi = $data->getProvinsi() ? $data->getProvinsi()->getId()->getValue() : null;
        return $el;
    }
}
