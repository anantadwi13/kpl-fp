<?php

namespace App\Core\Domain\Model\ValueObject;

class RuanganStatus
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

    static function AVAILABLE(): RuanganStatus
    {
        return new RuanganStatus(1);
    }

    static function MAINTENANCE(): RuanganStatus
    {
        return new RuanganStatus(0);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function isEqual(?RuanganStatus $other): bool
    {
        return $other != null
            && $this->getValue() === $other->getValue();
    }
}
