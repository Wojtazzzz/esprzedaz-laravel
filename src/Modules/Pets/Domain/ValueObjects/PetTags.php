<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Domain\ValueObjects;

readonly class PetTags
{
    /**
     * @var string[]
     */
    public array $values;

    public function __construct(string|array $value)
    {
        if (is_string($value)) {
            $this->setFromString($value);
        } elseif (is_array($value)) {
            $this->setFromArray($value);
        } else {
            $this->values = [];
        }
    }

    private function setFromString(string $value): void
    {
        if (! $value) {
            $this->values = [];
        } else {
            $this->setFromArray(explode(',', $value));
        }
    }

    private function setFromArray(array $value): void
    {
        $stringValues = array_filter($value, 'is_string');
        $trimmedValues = array_map('trim', $stringValues);

        $this->values = array_filter($trimmedValues);
    }
}
