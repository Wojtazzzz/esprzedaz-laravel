<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Modules\Pets\Application\Dtos\CreatePetDto;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'category' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'photos' => [
                'required',
                'string',
            ],
            'tags' => [
                'required',
                'string',
            ],
            'status' => [
                'required',
                'string',
            ]
        ];
    }

    public function toDto(): CreatePetDto
    {
        $data = $this->validated();

        return new CreatePetDto(
            name: $data['name'],
            category: $data['category'],
            photos: $data['photos'],
            tags: $data['tags'],
            status: $data['status'],
        );
    }
}
