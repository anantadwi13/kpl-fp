<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\UserStatus;

abstract class User
{
    private int $id;
    private string $nama;
    private string $username;
    private string $email;
    private string $noIdentitas;
    private string $noHp;
    private Alamat $alamat;
    private ?string $password;
    private UserStatus $status;

    /**
     * User constructor.
     * @param int $id
     * @param string $nama
     * @param string $username
     * @param string $email
     * @param string $noIdentitas
     * @param string $noHp
     * @param Alamat $alamat
     * @param UserStatus $status
     */
    public function __construct(
        int $id,
        string $nama,
        string $username,
        string $email,
        string $noIdentitas,
        string $noHp,
        Alamat $alamat,
        UserStatus $status
    ) {
        $this->id = $id;
        $this->nama = $nama;
        $this->username = $username;
        $this->email = $email;
        $this->noIdentitas = $noIdentitas;
        $this->noHp = $noHp;
        $this->alamat = $alamat;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getNoIdentitas(): string
    {
        return $this->noIdentitas;
    }

    /**
     * @return string
     */
    public function getNoHp(): string
    {
        return $this->noHp;
    }

    /**
     * @return Alamat
     */
    public function getAlamat(): Alamat
    {
        return $this->alamat;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return UserStatus
     */
    public function getStatus(): UserStatus
    {
        return $this->status;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}
