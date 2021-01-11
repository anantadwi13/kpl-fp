<?php


namespace App\Core\UseCase\Report;


use App\Core\Domain\Model\Entity\Report;
use App\Core\Domain\Model\Entity\User;
use App\Core\Domain\Model\Entity\UserAdmin;
use App\Core\Domain\Repository\ReportRepository;

class GetListReport
{
    private ReportRepository $reportRepository;

    /**
     * GetListReport constructor.
     * @param ReportRepository $reportRepository
     */
    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * @param User $user
     * @return Report[]
     */
    public function execute(User $user): array
    {
        if ($user instanceof UserAdmin)
            return $this->reportRepository->getAll();

        return $this->reportRepository->getByPelapor($user);
    }
}
