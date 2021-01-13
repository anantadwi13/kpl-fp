<?php


namespace App\Transformer;


use App\Core\Domain\Model\Entity\Report;
use App\Core\Domain\Model\ValueObject\Id;
use App\Core\Domain\Model\ValueObject\ReportStatus;

class ReportTransformer
{
    private UserTransformer $userTransformer;

    /**
     * ReportTransformer constructor.
     * @param UserTransformer $userTransformer
     */
    public function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    public function fromEloquent(\App\Report $el): Report
    {
        switch ($el->status) {
            case \App\Report::STATUS_READ:
                $status = ReportStatus::READ();
                break;
            default:
                $status = ReportStatus::UNREAD();
        }

        return new Report(
            new Id($el->id),
            $this->userTransformer->fromEloquent($el->pelapor),
            $this->userTransformer->fromEloquent($el->dilapor),
            $el->subject,
            $el->isi,
            $status
        );
    }

    public function toEloquent(Report $data): \App\Report
    {
        $el = new \App\Report();
        $el->id = $data->getId()->getValue();
        $el->id_pelapor = $data->getPelapor()->getId()->getValue();
        $el->id_dilapor = $data->getDilapor()->getId()->getValue();
        $el->subject = $data->getSubject();
        $el->isi = $data->getIsi();

        switch ($data->getStatus()->getValue()) {
            case ReportStatus::READ()->getValue():
                $el->status = \App\Report::STATUS_READ;
                break;
            default:
                $el->status = \App\Report::STATUS_UNREAD;
        }

        return $el;
    }
}
