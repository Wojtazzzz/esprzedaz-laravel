<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Domain\ValueObjects;

use Src\Common\Exceptions\DomainException;

readonly class PetStatus
{
    public string $value;

    /**
     * @throws DomainException
     */
    public function __construct(string $status)
    {
        $statusLower = strtolower($status);

        if (! in_array($statusLower, ['available', 'unavailable'])) {
            throw new DomainException("Invalid pet status: $status");
        }

        $this->value = $statusLower;
    }
}
