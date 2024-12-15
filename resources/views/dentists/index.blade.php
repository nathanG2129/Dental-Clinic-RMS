<x-layout.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dentists') }}
            </h2>
            @php
                $role = auth()->user()->role;
            @endphp
            @if($role === 'admin')
                <a href="{{ route('admin.dentists.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Add New Dentist
                </a>
            @endif
        </div>
    </x-slot>

    <x-card>
        <!-- Search and Filters -->
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.dentists.index') }}">
                <div class="flex items-end space-x-4">
                    <div class="flex-grow">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Dentists</label>
                        <input type="text" name="search" id="search" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Search by name or specialization..."
                            value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
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
                            <a href="{{ route('admin.dentists.show', $dentist) }}" class="text-blue-500 hover:text-blue-700">
                                View
                            </a>
                            @if($role === 'admin')
                                <a href="{{ route('admin.dentists.edit', $dentist) }}" class="text-yellow-500 hover:text-yellow-700">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.dentists.destroy', $dentist) }}" class="inline">
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