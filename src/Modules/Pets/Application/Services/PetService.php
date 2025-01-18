<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Application\Services;

use Src\Common\Exceptions\ApplicationException;
use Src\Common\Exceptions\DomainException;
use Src\Modules\Pets\Application\Dtos\CreatePetDto;
use Src\Modules\Pets\Application\Dtos\UpdatePetDto;
use Src\Modules\Pets\Domain\Entities\Pet;
use Src\Modules\Pets\Domain\PetClient;
use Src\Modules\Pets\Domain\ValueObjects\PetPhotos;
use Src\Modules\Pets\Domain\ValueObjects\PetStatus;
use Src\Modules\Pets\Domain\ValueObjects\PetTags;

final readonly class PetService
{
    public function __construct(private PetClient $petClient) {}

    /**
     * @throws DomainException
     */
    public function createPet(CreatePetDto $dto): string|false
    {
        $pet = new Pet($this->petClient);

        return $pet->create(
            category: $dto->category,
            name: $dto->name,
            photos: new PetPhotos($dto->photos),
            tags: new PetTags($dto->tags),
            status: new PetStatus($dto->status)
        );
    }

    /**
     * @throws DomainException
     * @throws ApplicationException
     */
    public function updatePet(UpdatePetDto $dto): void
    {
        if (! $this->getPetById($dto->id)) {
            throw new ApplicationException("Pet {$dto->id} not exists!");
        }

        $pet = new Pet($this->petClient);

        $pet->update(
            id: $dto->id,
            category: $dto->category,
            name: $dto->name,
            photos: new PetPhotos($dto->photos),
            tags: new PetTags($dto->tags),
            status: new PetStatus($dto->status)
        );
    }

    public function getPetById(string $id): array|false
    {
        return $this->petClient->getPetById($id);
    }

    public function deletePetById(string $id): bool
    {
        return $this->petClient->deletePetById($id);
    }
}
