@props([
    'title' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-sm sm:rounded-lg']) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $title }}
            </h3>
        </div>
    @endif
    
    <div class="p-6 bg-white">
        {{ $slot }}
    </div>
</div> 