<?php

namespace Tests\Unit;

use App\Core\Domain\Exception\EntityInvalidAttributeException;
use App\Core\Domain\Model\Entity\Kategori;
use App\Core\Domain\Model\Entity\Kecamatan;
use App\Core\Domain\Model\Entity\KotaKab;
use App\Core\Domain\Model\Entity\Provinsi;
use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserAdmin;
use App\Core\Domain\Model\Entity\UserPeminjam;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Model\ValueObject\RuanganStatus;
use App\Core\Domain\Model\ValueObject\UserStatus;
use Tests\TestCase;

class RuanganEntityTest extends TestCase
{
    private $alamat;
    private $penyedia;
    private $kategori;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->alamat = new Alamat(
            "Jalan jalan",
            new Kecamatan(new Id(1), 1, "Kecamatan 1"),
            new KotaKab(new Id(1), 1, "KotaKab 1"),
            new Provinsi(new Id(1), 1, "Provinsi 1"),
        );
        $this->penyedia = new UserPenyedia(
            new Id(1),
            "Penyedia 1",
            "penyedia",
            "penyedia@email.com",
            "3578192836123456",
            "081234567890",
            $this->alamat,
            UserStatus::ACTIVE()
        );
        $this->kategori = new Kategori(new Id(1), "Kategori 1");
    }

    public function testShouldHaveMinimumInformation()
    {
        try {
            new Ruangan(
                Id::UNSET(),
                "Ruangan A",
                $this->penyedia,
                RuanganStatus::AVAILABLE(),
                $this->kategori
            );
            $this->assertTrue(true);
        } catch (EntityInvalidAttributeException $exception){
            $this->assertTrue(false);
        }
    }

    public function testHasSameAddress()
    {
        try {
            $ruangan = new Ruangan(
                Id::UNSET(),
                "Ruangan A",
                $this->penyedia,
                RuanganStatus::AVAILABLE(),
                $this->kategori,
                null,
                $this->alamat
            );

            $this->assertTrue($ruangan->getAlamat()->isEqual($this->alamat));
        } catch (EntityInvalidAttributeException $exception){
            $this->assertTrue(false);
        }
    }

    public function testHasDifferentAddress()
    {
        try {
            $alamatRuangan = new Alamat(
                "Jalan Raya",
                new Kecamatan(new Id(1), 1, "Kecamatan 1"),
                new KotaKab(new Id(1), 1, "KotaKab 1"),
                new Provinsi(new Id(1), 1, "Provinsi 1"),
            );

            $ruangan = new Ruangan(
                Id::UNSET(),
                "Ruangan A",
                $this->penyedia,
                RuanganStatus::AVAILABLE(),
                $this->kategori,
                null,
                $alamatRuangan
            );

            $this->assertFalse($ruangan->getAlamat()->isEqual($this->alamat));
        } catch (EntityInvalidAttributeException $exception){
            $this->assertTrue(false);
        }
    }

    public function testVendorShouldBeUserPenyedia()
    {
        try {
            $userPeminjam = new UserPeminjam(
                new Id(2),
                "Peminjam 1",
                "peminjam",
                "peminjam@email.com",
                "3578192836123456",
                "081234567890",
                $this->alamat,
                UserStatus::ACTIVE()
            );

            new Ruangan(
                Id::UNSET(),
                "Ruangan A",
                $userPeminjam,
                RuanganStatus::AVAILABLE(),
                $this->kategori,
            );

            $this->assertTrue(false);
            return;
        } catch (\TypeError $exception){

        }

        try {
            $userAdmin = new UserAdmin(
                new Id(2),
                "Peminjam 1",
                "peminjam",
                "peminjam@email.com",
                "3578192836123456",
                "081234567890",
                $this->alamat,
                UserStatus::ACTIVE()
            );

            new Ruangan(
                Id::UNSET(),
                "Ruangan A",
                $userAdmin,
                RuanganStatus::AVAILABLE(),
                $this->kategori,
            );

            $this->assertTrue(false);
            return;
        } catch (\TypeError $exception){

        }

        try {
            new Ruangan(
                Id::UNSET(),
                "Ruangan A",
                $this->penyedia,
                RuanganStatus::AVAILABLE(),
                $this->kategori,
            );

            $this->assertTrue(true);
        } catch (\TypeError $exception){
            $this->assertTrue(false);
        }
    }
}
