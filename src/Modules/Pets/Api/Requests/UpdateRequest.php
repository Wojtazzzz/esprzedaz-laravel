<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Modules\Pets\Application\Dtos\UpdatePetDto;

class UpdateRequest extends FormRequest
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

    public function toDto(): UpdatePetDto
    {
        $data = $this->validated();

        return new UpdatePetDto(
            id: $this->pet,
            name: $data['name'],
            category: $data['category'],
            photos: $data['photos'],
            tags: $data['tags'],
            status: $data['status'],
        );
    }
}
