<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Domain\Entities;

use Src\Modules\Pets\Domain\PetClient;
use Src\Modules\Pets\Domain\ValueObjects\PetPhotos;
use Src\Modules\Pets\Domain\ValueObjects\PetStatus;
use Src\Modules\Pets\Domain\ValueObjects\PetTags;

final readonly class Pet
{
    public function __construct(
        private PetClient $petClient
    )
    {
    }

    public function create(string $category, string $name, PetPhotos $photos, PetTags $tags, PetStatus $status): void
    {
        $this->petClient->create(
            category: $category,
            name: $name,
            photos: $photos->values,
            tags: $tags->values,
            status: $status->value
        );
    }
}
