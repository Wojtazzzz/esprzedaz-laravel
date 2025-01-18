@extends('common::layout')
<div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 flex flex-col gap-y-8">
    <h1 class="text-2xl font-semibold text-gray-800 text-center">Something went wrong</h1>
    <h2 class="text-lg font-semibold text-gray-800 text-center">
        @empty($message)
            Please try again later.
        @else
            {{ $message }}
        @endempty
    </h2>
</div>
