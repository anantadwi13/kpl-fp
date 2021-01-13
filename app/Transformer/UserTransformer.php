<?php


namespace App\Transformer;


use App\Core\Domain\Exception\UserUnknownException;
use App\Core\Domain\Model\Entity\User;
use App\Core\Domain\Model\Entity\UserAdmin;
use App\Core\Domain\Model\Entity\UserPeminjam;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Model\ValueObject\UserStatus;

class UserTransformer
{
    private KecamatanTransformer $kecamatanTransformer;
    private KotaKabTransformer $kotaKabTransformer;
    private ProvinsiTransformer $provinsiTransformer;

    /**
     * UserTransformer constructor.
     * @param KecamatanTransformer $kecamatanTransformer
     * @param KotaKabTransformer $kotaKabTransformer
     * @param ProvinsiTransformer $provinsiTransformer
     */
    public function __construct(
        KecamatanTransformer $kecamatanTransformer,
        KotaKabTransformer $kotaKabTransformer,
        ProvinsiTransformer $provinsiTransformer
    ) {
        $this->kecamatanTransformer = $kecamatanTransformer;
        $this->kotaKabTransformer = $kotaKabTransformer;
        $this->provinsiTransformer = $provinsiTransformer;
    }

    public function fromEloquent(\App\User $el): User
    {
        $alamat = new Alamat(
            $el->alamat_jalan,
            $this->kecamatanTransformer->fromEloquent($el->kecamatan),
            $this->kotaKabTransformer->fromEloquent($el->kecamatan->kotakab),
            $this->provinsiTransformer->fromEloquent($el->kecamatan->kotakab->provinsi)
        );

        switch ($el->status) {
            case \App\User::STATUS_ACTIVE:
                $status = UserStatus::ACTIVE();
                break;
            case \App\User::STATUS_BANNED:
                $status = UserStatus::BANNED();
                break;
            default:
                $status = UserStatus::NONACTIVE();
        }

        switch ($el->tipe_akun) {
            case \App\User::TYPE_ADMIN:
                return new UserAdmin(
                    new Id($el->id),
                    $el->nama,
                    $el->username,
                    $el->email,
                    $el->no_identitas ?? "",
                    $el->nohp,
                    $alamat,
                    $status,
                    $el->password
                );
            case \App\User::TYPE_PENYEDIA:
                return new UserPenyedia(
                    new Id($el->id),
                    $el->nama,
                    $el->username,
                    $el->email,
                    $el->no_identitas ?? "",
                    $el->nohp,
                    $alamat,
                    $status,
                    $el->password
                );
            case \App\User::TYPE_PEMINJAM:
                return new UserPeminjam(
                    new Id($el->id),
                    $el->nama,
                    $el->username,
                    $el->email,
                    $el->no_identitas ?? "",
                    $el->nohp,
                    $alamat,
                    $status,
                    $el->password
                );
            default:
                throw new UserUnknownException();
        }
    }

    public function toEloquent(User $data): \App\User
    {
        $el = new \App\User();

        if ($data instanceof UserAdmin) {
            $el->tipe_akun = \App\User::TYPE_ADMIN;
        } elseif ($data instanceof UserPenyedia) {
            $el->tipe_akun = \App\User::TYPE_PENYEDIA;
        } elseif ($data instanceof UserPeminjam) {
            $el->tipe_akun = \App\User::TYPE_PEMINJAM;
        } else {
            throw new UserUnknownException();
        }

        $el->id = $data->getId()->getValue();
        $el->nama = $data->getNama();
        $el->username = $data->getUsername();
        $el->email = $data->getEmail();
        $el->no_identitas = $data->getNoIdentitas();
        $el->nohp = $data->getNoHp();
        $el->alamat_jalan = $data->getAlamat()->getJalan();
        $el->alamat_kecamatan = $data->getAlamat()->getKecamatan()->getId()->getValue();

        if ($data->getHashedPassword()) {
            $el->password = $data->getHashedPassword();
        }

        switch ($data->getStatus()->getValue()) {
            case UserStatus::ACTIVE()->getValue():
                $el->status = \App\User::STATUS_ACTIVE;
                break;
            case UserStatus::NONACTIVE()->getValue():
                $el->status = \App\User::STATUS_BANNED;
                break;
            default:
                $el->status = \App\User::STATUS_NONACTIVE;
        }

        return $el;
    }
}
