<?php

namespace App\Core\Domain\Model\ValueObject;

class ReportStatus
{
    private int $value;

    /**
     * UserStatus constructor.
     * @param int $value
     */
    private function __construct(int $value)
    {
        $this->value = $value;
    }

    static function UNREAD(): ReportStatus
    {
        return new ReportStatus(0);
    }

    static function READ(): ReportStatus
    {
        return new ReportStatus(1);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
