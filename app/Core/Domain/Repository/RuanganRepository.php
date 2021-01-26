<?php


namespace App\Core\Domain\Repository;


use App\Core\Domain\Exception\RepositoryPersistException;
use App\Core\Domain\Exception\RepositoryDeleteException;
use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Model\ValueObject\Id;

interface RuanganRepository
{
    /**
     * @return Ruangan[]
     */
    public function getAll(): array;

    /**
     * @param UserPenyedia $penyedia
     * @return Ruangan[]
     */
    public function getByPenyedia(UserPenyedia $penyedia): array;

    /**
     * @param Id $id
     * @return Ruangan|null
     */
    public function getById(Id $id): ?Ruangan;

    /**
     * @param Ruangan $ruangan
     * @throws RepositoryPersistException
     */
    public function persist(Ruangan $ruangan): void;

    /**
     * @param Ruangan $ruangan
     * @throws RepositoryDeleteException
     */
    public function delete(Ruangan $ruangan): void;
}
