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
     * @param string $category
     * @param string $name
     * @param string[] $photos
     * @param string[] $tags
     * @param string $status
     * @return bool
     * @throws InfrastructureException
     */
    public function create(string $category, string $name, array $photos, array $tags, string $status): bool
    {
        try {
            $response = $this->http->post('/pet', [
                'category' => [
                    'name' => $category
                ],
                'name' => $name,
                'photoUrls' => $photos,
                'tags' => $tags,
                'status' => $status,
            ]);

            return $response->successful();
        } catch (ConnectionException $e) {
            throw new InfrastructureException('Cannot connect to pets server.');
        }
    }
}
