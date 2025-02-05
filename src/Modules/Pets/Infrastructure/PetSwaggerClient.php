<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Infrastructure;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Src\Common\Exceptions\InfrastructureException;
use Src\Modules\Pets\Domain\PetClient;

final class PetSwaggerClient implements PetClient
{
    private PendingRequest $http;

    public function __construct()
    {
        $this->http = Http::baseUrl('https://petstore.swagger.io/v2');
    }

    /**
     * @param  string[]  $photos
     * @param  string[]  $tags
     *
     * @throws InfrastructureException
     */
    public function createPet(string $category, string $name, array $photos, array $tags, string $status): string|false
    {
        try {
            $response = $this->http->post('/pet', [
                'category' => [
                    'name' => $category,
                ],
                'name' => $name,
                'photoUrls' => $photos,
                'tags' => array_map(fn (string $tag) => ['name' => $tag], $tags),
                'status' => $status,
            ]);

            if (! $response->successful()) {
                return false;
            }

            if ($response->json('id')) {
                return (string) $response->json('id');
            }

            return false;
        } catch (ConnectionException $e) {
            throw new InfrastructureException('Cannot connect to pets server.');
        }
    }

    /**
     * @throws InfrastructureException
     */
    public function getPetById(string $petId): array|false
    {
        try {
            $response = $this->http->get("/pet/{$petId}");

            if ($response->notFound()) {
                return false;
            }

            return (array) $response->json();
        } catch (ConnectionException $e) {
            throw new InfrastructureException('Cannot connect to pets server.');
        }
    }

    /**
     * @throws InfrastructureException
     */
    public function deletePetById(string $petId): bool
    {
        try {
            $response = $this->http->delete("/pet/{$petId}");

            if ($response->notFound()) {
                return false;
            }

            return $response->successful();
        } catch (ConnectionException $e) {
            throw new InfrastructureException('Cannot connect to pets server.');
        }
    }

    /**
     * @throws InfrastructureException
     */
    public function updatePet(string $id, string $category, string $name, array $photos, array $tags, string $status): string|false
    {
        try {
            $response = $this->http->post('/pet', [
                'id' => $id,
                'category' => [
                    'name' => $category,
                ],
                'name' => $name,
                'photoUrls' => $photos,
                'tags' => array_map(fn (string $tag) => ['name' => $tag], $tags),
                'status' => $status,
            ]);

            if (! $response->successful()) {
                return false;
            }

            if ($response->json('id')) {
                return (string) $response->json('id');
            }

            return false;
        } catch (ConnectionException $e) {
            throw new InfrastructureException('Cannot connect to pets server.');
        }
    }
}
