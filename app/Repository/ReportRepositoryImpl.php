<?php


namespace App\Repository;


use App\Core\Domain\Model\Entity\Report;
use App\Core\Domain\Model\Entity\User;
use App\Core\Domain\Repository\ReportRepository;
use App\Transformer\ReportTransformer;

class ReportRepositoryImpl implements ReportRepository
{
    private ReportTransformer $reportTransformer;

    /**
     * ReportRepositoryImpl constructor.
     * @param ReportTransformer $reportTransformer
     */
    public function __construct(ReportTransformer $reportTransformer)
    {
        $this->reportTransformer = $reportTransformer;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $allReport = \App\Report::all();
        $listReport = [];

        foreach ($allReport as $report) {
            $listReport[] = $this->reportTransformer->fromEloquent($report);
        }

        return $listReport;
    }

    /**
     * @inheritDoc
     */
    public function getByPelapor(User $user): array
    {
        $allReport = \App\Report::whereIdPelapor($user->getId());
        $listReport = [];

        foreach ($allReport as $report) {
            $listReport[] = $this->reportTransformer->fromEloquent($report);
        }

        return $listReport;
    }
}
