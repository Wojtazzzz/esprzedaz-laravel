@extends('common::layout')
<div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Find pet by ID</h1>

    @includeWhen($pet === false, 'common::alert', [
        'type' => 'error',
        'content' => 'Pet not found',
    ])

    @includeWhen(session('message'), 'common::alert', [
        'type' => 'success',
        'content' => session('message'),
    ])

    @includeWhen(session('error'), 'common::alert', [
        'type' => 'error',
        'content' => session('error'),
    ])

    <form action="{{ route('pets.show') }}" method="GET" class="space-y-4">
        <div>
            @include('common::input_text', [
                'id' => 'id',
                'label' => 'ID of pet',
                'name' => 'id',
                'placeholder' => '12345',
                'type' => 'text',
                'value' => request('id')
            ])
        </div>

        <div>
            @include('common::button', [
                'label' => 'Search',
                'type' => 'submit',
            ])
        </div>
    </form>


    @if ($pet)
        <div class="mb-4">
            <a
                href="{{ route('pets.edit', ['pet' => $pet['id']]) }}"
                class="w-full inline-block text-center bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Edit pet
            </a>
        </div>

        <form action="{{ route('pets.destroy', ['pet' => $pet['id']]) }}" method="POST">
            @csrf
            @method('DELETE')

            <div>
                @include('common::button', [
                    'label' => 'Delete',
                    'type' => 'submit',
                ])
            </div>
        </form>

        <div class="space-y-4 mt-8">
            <div>
                <span>Name: {{ $pet['name'] ?? '-' }}</span>
            </div>
            @isset($pet['category']['name'])
                <div>
                    <span>Category: {{ $pet['category']['name'] }}</span>
                </div>
            @endisset
            @if ($pet['photoUrls'])
                <div>
                    Photos:
                    <ul>
                        @foreach($pet['photoUrls'] as $url)
                            <li>{{ $url }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($pet['tags'])
                <div>
                    Tags:
                    <ul>
                        @foreach($pet['tags'] as $tag)
                            <li>{{ $tag['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <span>Status: {{ $pet['status'] ?? '-' }}</span>
            </div>
        </div>
    @endif
</div>
