<?php

namespace App\Core\Domain\Model\ValueObject;

class Id
{
    private int $value;

    /**
     * Id constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    static function UNSET(): Id
    {
        return new Id(-1);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function isEqual(?Id $other): bool
    {
        return $other != null && $this->getValue() === $other->getValue();
    }

    public function __toString(): string
    {
        return strval($this->getValue());
    }
}
