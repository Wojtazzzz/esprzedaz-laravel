<label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900">
    {{ $label }}
</label>
<input
    type="{{ $type }}"
    id="{{ $id  }}"
    name="{{ $name  }}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
    @isset($placeholder) placeholder="{{ $placeholder }}" @endif
    required
    @isset($value) value="{{ $value }}" @endisset
/>
