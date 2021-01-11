<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Model\ValueObject\Alamat;
use App\Core\Domain\Model\ValueObject\UserStatus;

class UserAdmin extends User
{
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
        parent::__construct($id, $nama, $username, $email, $noIdentitas, $noHp, $alamat, $status);
    }
}
