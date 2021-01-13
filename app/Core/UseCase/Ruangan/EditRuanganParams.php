<?php


namespace App\Core\UseCase\Ruangan;


use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserPenyedia;

class EditRuanganParams
{
    public Ruangan $latestRuangan;
    public ?string $nama;
    public ?string $kode;
    public ?int $idKategori;
    public ?UserPenyedia $penyedia;
    public ?string $alamatJalan;
    public ?int $idKecamatan;
    public ?int $status;
}
