<?php

namespace App\Core\Domain\Model\ValueObject;

class UserStatus
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

    static function ACTIVE(): UserStatus
    {
        return new UserStatus(2);
    }

    static function NONACTIVE(): UserStatus
    {
        return new UserStatus(1);
    }

    static function BANNED(): UserStatus
    {
        return new UserStatus(0);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function isEqual(?UserStatus $other): bool
    {
        return $other != null
            && $this->getValue() === $other->getValue();
    }
}
