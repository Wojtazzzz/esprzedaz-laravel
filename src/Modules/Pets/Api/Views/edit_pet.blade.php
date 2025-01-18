@extends('common::layout')
<div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Edit Pet "{{ $pet['name'] }}"</h1>

    @includeWhen(session('message'), 'common::alert', [
        'type' => 'success',
        'content' => session('message'),
    ])

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    @include('common::alert', [
                        'type' => 'error',
                        'content' => $error,
                    ])
                </li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('pets.update', ['pet' => $pet['id']]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            @include('common::input_text', [
                'id' => 'name',
                'label' => 'Pet name',
                'name' => 'name',
                'placeholder' => 'Rex',
                'type' => 'text',
                'value' => $pet['name']
            ])
        </div>

        <div>
            @include('common::input_text', [
                'id' => 'category',
                'label' => 'Category',
                'name' => 'category',
                'placeholder' => 'Dog',
                'type' => 'text',
                'value' => $pet['category']['name']
            ])
        </div>

        <div>
            @include('common::textarea', [
                'name' => 'photos',
                'id' => 'photos',
                'label' => 'URL addresses of photos, each on a new line',
                'value' => join(', ', $pet['photoUrls'])
            ])
        </div>

        <div>
            @include('common::input_text', [
                'id' => 'tags',
                'label' => 'Tags, separated by commas',
                'name' => 'tags',
                'type' => 'text',
                'value' => collect($pet['tags'])->map(fn ($tag) => $tag['name'])->join(', ')
            ])
        </div>

        <div>
            @include('common::select', [
                'id' => 'status',
                'label' => 'Status',
                'name' => 'status',
                'options' => ['available' => 'Available', 'unavailable' => 'Unavailable'],
                'value' => $pet['status']
            ])
        </div>

        <div>
            @include('common::button', [
                'label' => 'Update',
                'type' => 'submit',
            ])
        </div>
    </form>
</div>
