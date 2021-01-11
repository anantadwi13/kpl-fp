<?php

namespace App\Core\Domain\Model\ValueObject;

class ReservasiStatus
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

    static function WAITING(): ReservasiStatus
    {
        return new ReservasiStatus(0);
    }

    static function REJECTED(): ReservasiStatus
    {
        return new ReservasiStatus(0);
    }

    static function ACCEPTED(): ReservasiStatus
    {
        return new ReservasiStatus(2);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
