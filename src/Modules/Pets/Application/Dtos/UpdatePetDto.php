<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Application\Dtos;

readonly class UpdatePetDto
{
    /**
     * @param  string[]  $photos
     * @param  string[]  $tags
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $category,
        public array|string $photos,
        public array|string $tags,
        public string $status,
    ) {}
}
