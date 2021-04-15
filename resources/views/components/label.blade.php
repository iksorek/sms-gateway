@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-gray-800']) }}>
    {{ $value ?? $slot }}
</label>
