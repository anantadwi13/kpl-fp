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
    private UserStatus $status;
    private ?string $hashedPassword;

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
     * @param string|null $hashedPassword
     */
    public function __construct(
        int $id,
        string $nama,
        string $username,
        string $email,
        string $noIdentitas,
        string $noHp,
        Alamat $alamat,
        UserStatus $status,
        ?string $hashedPassword = null
    ) {
        $this->id = $id;
        $this->nama = $nama;
        $this->username = $username;
        $this->email = $email;
        $this->noIdentitas = $noIdentitas;
        $this->noHp = $noHp;
        $this->alamat = $alamat;
        $this->status = $status;
        $this->hashedPassword = $hashedPassword;
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
     * get hashed password
     * @return string
     */
    public function getHashedPassword(): ?string
    {
        return $this->hashedPassword;
    }

    /**
     * @return UserStatus
     */
    public function getStatus(): UserStatus
    {
        return $this->status;
    }

    /**
     * @param string|null $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->hashedPassword = bcrypt($plainPassword);
    }

    /**
     * @param string|null $hashedPassword
     */
    public function setHashedPassword(string $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }

}
