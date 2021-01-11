<?php


namespace App\Transformer;


use App\Core\Domain\Model\Entity\Kecamatan;

class KecamatanTransformer
{
    private KotaKabTransformer $kotaKabTransformer;

    /**
     * KecamatanTransformer constructor.
     * @param KotaKabTransformer $kotaKabTransformer
     */
    public function __construct(KotaKabTransformer $kotaKabTransformer)
    {
        $this->kotaKabTransformer = $kotaKabTransformer;
    }

    public function fromEloquent(\App\Kecamatan $el): Kecamatan
    {
        $kotaKab = $el->kotakab ? $this->kotaKabTransformer->fromEloquent($el->kotakab) : null;

        return new Kecamatan($el->id, $el->kode_kecamatan, $el->nama, $kotaKab);
    }

    public function toEloquent(Kecamatan $data): \App\Kecamatan
    {
        $el = new \App\Kecamatan();
        $el->id = $data->getId();
        $el->nama = $data->getNama();
        $el->kode_kecamatan = $data->getKodeKecamatan();
        $el->id_kota = $data->getKotaKab() ? $data->getKotaKab()->getId() : null;
        return $el;
    }
}
