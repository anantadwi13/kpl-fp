<?php


namespace App\Core\UseCase\Dashboard;


use App\Core\Domain\Model\Entity\User;
use App\Core\UseCase\Report\GetListReport;

class CountReport
{
    private GetListReport $getListReport;

    /**
     * CountReport constructor.
     * @param GetListReport $getListReport
     */
    public function __construct(GetListReport $getListReport)
    {
        $this->getListReport = $getListReport;
    }

    public function execute(User $user): int
    {
        return count($this->getListReport->execute($user));
    }
}
