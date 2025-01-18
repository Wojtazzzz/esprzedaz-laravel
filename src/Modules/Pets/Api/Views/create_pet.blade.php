@extends('common::layout')
<div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Create new Pet</h1>

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

    <form action="{{ route('pets.store') }}" method="POST" class="space-y-4">
        @csrf
        @method('POST')

        <div>
            @include('common::input_text', [
                'id' => 'name',
                'label' => 'Pet name',
                'name' => 'name',
                'placeholder' => 'Rex',
                'type' => 'text',
            ])
        </div>

        <div>
            @include('common::input_text', [
                'id' => 'category',
                'label' => 'Category',
                'name' => 'category',
                'placeholder' => 'Dog',
                'type' => 'text',
            ])
        </div>

        <div>
            @include('common::textarea', [
                'name' => 'photos',
                'id' => 'photos',
                'label' => 'URL addresses of photos, each on a new line',
            ])
        </div>

        <div>
            @include('common::input_text', [
                'id' => 'tags',
                'label' => 'Tags, separated by commas',
                'name' => 'tags',
                'type' => 'text',
            ])
        </div>

        <div>
            @include('common::select', [
                'id' => 'status',
                'label' => 'Status',
                'name' => 'status',
                'options' => ['available' => 'Available', 'unavailable' => 'Unavailable'],
            ])
        </div>

        <div>
            @include('common::button', [
                'label' => 'Create',
                'type' => 'submit',
            ])
        </div>
    </form>
</div>
