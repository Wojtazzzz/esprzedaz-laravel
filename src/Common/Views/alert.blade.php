<div
    role="alert"
    @class([
        'p-4 mb-4 text-sm rounded-lg',
        'text-green-800 bg-green-100' => $type === 'success',
        'text-red-800 bg-red-50' => $type === 'error',
    ])
>
    <span class="font-medium">
        @switch($type)
            @case('success')
                Success!
                @break

            @case('error')
                Error!
                @break
        @endswitch
    </span>

    {{ $content }}
</div>
