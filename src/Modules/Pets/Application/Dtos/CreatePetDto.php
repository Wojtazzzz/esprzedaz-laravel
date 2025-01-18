<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Application\Dtos;

readonly class CreatePetDto
{
    /**
     * @param string $name
     * @param string $category
     * @param string[] $photos
     * @param string[] $tags
     * @param string $status
     */
    public function __construct(
        public string       $name,
        public string       $category,
        public array|string $photos,
        public array|string $tags,
        public string       $status,
    )
    {
    }
}
