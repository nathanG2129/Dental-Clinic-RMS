<x-layout.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dentists') }}
            </h2>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('dentists.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Add New Dentist
                </a>
            @endif
        </div>
    </x-slot>

    <x-card>
        <!-- Search and Filters -->
        <div class="mb-4">
            <form method="GET" action="{{ route('dentists.index') }}" class="flex gap-4">
                <x-form.input 
                    name="search" 
                    label="Search Dentists"
                    value="{{ request('search') }}"
                    placeholder="Search by name or specialization..."
                    class="flex-1"
                />
                <div class="flex items-end">
                    <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Dentists Table -->
        <x-table.table :headers="['Name', 'Specialization', 'Contact', 'Associated User', 'Actions']">
            @forelse($dentists as $dentist)
                <x-table.row :striped="$loop->even">
                    <x-table.cell>{{ $dentist->dentist_name }}</x-table.cell>
                    <x-table.cell>{{ $dentist->specialization }}</x-table.cell>
                    <x-table.cell>{{ $dentist->contact_information }}</x-table.cell>
                    <x-table.cell>{{ $dentist->user->name }} ({{ $dentist->user->email }})</x-table.cell>
                    <x-table.cell>
                        <div class="flex space-x-2">
                            <a href="{{ route('dentists.show', $dentist) }}" class="text-blue-500 hover:text-blue-700">
                                View
                            </a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('dentists.edit', $dentist) }}" class="text-yellow-500 hover:text-yellow-700">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('dentists.destroy', $dentist) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this dentist?')">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="5" class="text-center">No dentists found.</x-table.cell>
                </x-table.row>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $dentists->links() }}
        </div>
    </x-card>
</x-layout.app> 