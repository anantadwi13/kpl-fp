<?php


namespace App\Repository;


use App\Core\Domain\Exception\RepositoryDeleteException;
use App\Core\Domain\Exception\RepositoryPersistException;
use App\Core\Domain\Model\Entity\Ruangan;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Repository\RuanganRepository;
use App\Transformer\RuanganTransformer;
use Illuminate\Support\Facades\DB;

class RuanganRepositoryImpl implements RuanganRepository
{
    private RuanganTransformer $ruanganTransformer;

    /**
     * RuanganRepositoryImpl constructor.
     * @param RuanganTransformer $ruanganTransformer
     */
    public function __construct(RuanganTransformer $ruanganTransformer)
    {
        $this->ruanganTransformer = $ruanganTransformer;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $allRuangan = \App\Ruangan::all();
        $listRuangan = [];

        foreach ($allRuangan as $ruangan) {
            $listRuangan[] = $this->ruanganTransformer->fromEloquent($ruangan);
        }

        return $listRuangan;
    }

    /**
     * @inheritDoc
     */
    public function getByPenyedia(UserPenyedia $penyedia): array
    {
        $allRuangan = \App\Ruangan::whereIdUser($penyedia->getId()->getValue())->get();
        $listRuangan = [];

        foreach ($allRuangan as $ruangan) {
            $listRuangan[] = $this->ruanganTransformer->fromEloquent($ruangan);
        }

        return $listRuangan;
    }

    /**
     * @inheritDoc
     */
    public function getById(Id $id): ?Ruangan
    {
        $ruangan = \App\Ruangan::whereId($id->getValue())->first();

        if (!$ruangan) {
            return null;
        }

        return $this->ruanganTransformer->fromEloquent($ruangan);
    }

    /**
     * @inheritDoc
     */
    public function persist(Ruangan $ruangan): void
    {
        try {
            $ruanganEloquent = $this->ruanganTransformer->toEloquent($ruangan);

            if ($ruangan->getId()->isEqual(Id::UNSET())) {
                $ruanganEloquent->saveOrFail();
            } else {
                $updateRuangan = \App\Ruangan::whereId($ruangan->getId()->getValue())->first();
                $updateRuangan->nama = $ruanganEloquent->nama;
                $updateRuangan->kode = $ruanganEloquent->kode;
                $updateRuangan->id_kategori = $ruanganEloquent->id_kategori;
                $updateRuangan->alamat_jalan = $ruanganEloquent->alamat_jalan;
                $updateRuangan->alamat_kecamatan = $ruanganEloquent->alamat_kecamatan;
                $updateRuangan->status = $ruanganEloquent->status;
                $updateRuangan->saveOrFail();
            }
        } catch (\Throwable $e) {
            throw new RepositoryPersistException();
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(Ruangan $ruangan): void
    {
        try {
            $ruanganEloquent = \App\Ruangan::whereId($ruangan->getId())->first();

            DB::beginTransaction();

            if ($ruanganEloquent->reservasi()->count() > 0) {
                $ruanganEloquent->reservasi()->delete();
            }

            if (!$ruanganEloquent->delete()) {
                throw new RepositoryDeleteException();
            }

            DB::commit();
        } catch (\Exception $exception) {
            throw new RepositoryDeleteException();
        }
    }
}
