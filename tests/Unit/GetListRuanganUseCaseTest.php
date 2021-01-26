<?php

namespace Tests\Unit;

use App\Core\Domain\Model\Entity\Kategori;
use App\Core\Domain\Model\Entity\Kecamatan;
use App\Core\Domain\Model\Entity\KotaKab;
use App\Core\Domain\Model\Entity\Provinsi;
use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Model\ValueObject\RuanganStatus;
use App\Core\Domain\Model\ValueObject\UserStatus;
use App\Core\Domain\Repository\RuanganRepository;
use App\Core\UseCase\Ruangan\GetListRuangan;
use Tests\TestCase;

class GetListRuanganUseCaseTest extends TestCase
{
    private RuanganRepository $repository;
    private array $ruanganList;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $alamat = new Alamat(
            "Jalan jalan",
            new Kecamatan(new Id(1), 1, "Kecamatan 1"),
            new KotaKab(new Id(1), 1, "KotaKab 1"),
            new Provinsi(new Id(1), 1, "Provinsi 1"),
        );

        $penyedia = new UserPenyedia(
            new Id(1),
            "Penyedia 1",
            "penyedia",
            "penyedia@email.com",
            "3578192836123456",
            "081234567890",
            $alamat,
            UserStatus::ACTIVE()
        );

        $kategori = new Kategori(new Id(1), "Kategori 1");

        $ruangan = new Ruangan(
            Id::UNSET(),
            "Ruangan A",
            $penyedia,
            RuanganStatus::AVAILABLE(),
            $kategori
        );

        $this->ruanganList = [$ruangan, $ruangan, $ruangan];

        $this->repository = $this->createMock(RuanganRepository::class);

        $this->repository->method('getAll')->willReturn($this->ruanganList);
    }

    public function testGetAllRuangan(){
        $useCase = new GetListRuangan($this->repository);

        $allRuangan = $useCase->execute(null);

        for ($i = 0; $i < count($allRuangan); $i++){
            if ($allRuangan[$i] !== $this->ruanganList[$i]) {
                $this->assertTrue(false);
                return;
            }
        }

        $this->assertTrue(true);
    }
}
