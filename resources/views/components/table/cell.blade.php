@props(['align' => 'left'])

<td {{ $attributes->merge(['class' => 'border-t border-gray-200 px-6 py-4 text-' . $align]) }}>
    {{ $slot }}
</td> 