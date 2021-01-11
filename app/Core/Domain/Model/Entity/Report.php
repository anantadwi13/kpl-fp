<?php


namespace App\Core\Domain\Model\Entity;


use App\Core\Domain\Model\ValueObject\ReportStatus;

class Report
{
    private int $id;
    private User $pelapor;
    private User $dilapor;
    private string $subject;
    private string $isi;
    private ReportStatus $status;

    /**
     * Report constructor.
     * @param int $id
     * @param User $pelapor
     * @param User $dilapor
     * @param string $subject
     * @param string $isi
     * @param ReportStatus $status
     */
    public function __construct(
        int $id,
        User $pelapor,
        User $dilapor,
        string $subject,
        string $isi,
        ReportStatus $status
    ) {
        $this->id = $id;
        $this->pelapor = $pelapor;
        $this->dilapor = $dilapor;
        $this->subject = $subject;
        $this->isi = $isi;
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
     * @return User
     */
    public function getPelapor(): User
    {
        return $this->pelapor;
    }

    /**
     * @return User
     */
    public function getDilapor(): User
    {
        return $this->dilapor;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getIsi(): string
    {
        return $this->isi;
    }

    /**
     * @return ReportStatus
     */
    public function getStatus(): ReportStatus
    {
        return $this->status;
    }
}
