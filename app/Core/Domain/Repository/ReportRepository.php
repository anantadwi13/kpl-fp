<?php


namespace App\Core\Domain\Repository;


use App\Core\Domain\Model\Entity\Report;
use App\Core\Domain\Model\Entity\User;

interface ReportRepository
{
    /**
     * @return Report[]
     */
    public function getAll(): array;

    /**
     * @param User $user
     * @return Report[]
     */
    public function getByPelapor(User $user): array;
}
