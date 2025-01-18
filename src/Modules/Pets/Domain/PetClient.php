<?php

declare(strict_types=1);


namespace Src\Modules\Pets\Domain;

interface PetClient
{
    public function createPet(string $category, string $name, array $photos, array $tags, string $status): bool;

    public function updatePet(string $id, string $category, string $name, array $photos, array $tags, string $status): bool;

    public function getPetById(string $petId): array|false;

    public function deletePetById(string $petId): bool;
}
