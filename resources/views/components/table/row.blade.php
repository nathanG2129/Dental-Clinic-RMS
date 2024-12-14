@props(['striped' => false])

<tr {{ $attributes->merge(['class' => $striped ? 'bg-gray-50' : '']) }}>
    {{ $slot }}
</tr> 