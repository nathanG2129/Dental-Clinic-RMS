<x-layout.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Treatment Records') }}
            </h2>
            @php
                $role = auth()->user()->role;
                $createRoute = $role . '.treatment-records.create';
                $indexRoute = $role . '.treatment-records.index';
            @endphp
            <a href="{{ route($createRoute) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Add Treatment Record
            </a>
        </div>
    </x-slot>

    <x-card>
        <!-- Search and Filters -->
        <div class="mb-6">
            <form method="GET" action="{{ route($role . '.treatment-records.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <input type="text" name="search" id="search" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Search by patient name or treatment type..."
                            value="{{ request('search') }}">
                    </div>
                    <div>
                        <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                        <select name="payment_status" id="payment_status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">All Statuses</option>
                            @foreach($paymentStatuses as $status)
                                <option value="{{ $status }}" {{ request('payment_status') === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="dentist_id" class="block text-sm font-medium text-gray-700 mb-1">Dentist</label>
                        <select name="dentist_id" id="dentist_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="" selected>All Dentists</option>
                            @foreach($dentists as $dentist)
                                <option value="{{ $dentist->dentist_id }}" {{ (string)request('dentist_id') === (string)$dentist->dentist_id ? 'selected' : '' }}>
                                    {{ $dentist->dentist_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" name="start_date" id="start_date" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            value="{{ request('start_date') }}">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" name="end_date" id="end_date" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="min_cost" class="block text-sm font-medium text-gray-700 mb-1">Min Cost</label>
                            <input type="number" name="min_cost" id="min_cost" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ request('min_cost') }}"
                                min="0" step="0.01">
                        </div>
                        <div>
                            <label for="max_cost" class="block text-sm font-medium text-gray-700 mb-1">Max Cost</label>
                            <input type="number" name="max_cost" id="max_cost" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ request('max_cost') }}"
                                min="0" step="0.01">
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Treatment Records Table -->
        <x-table.table :headers="['Date', 'Patient', 'Dentist', 'Treatment', 'Cost', 'Payment Status', 'Actions']">
            @forelse($treatmentRecords as $record)
                <x-table.row :striped="$loop->even">
                    <x-table.cell>{{ $record->treatment_date->format('M d, Y') }}</x-table.cell>
                    <x-table.cell>{{ $record->patient->patient_name }}</x-table.cell>
                    <x-table.cell>{{ $record->dentist->dentist_name }}</x-table.cell>
                    <x-table.cell>{{ $record->treatment_type }}</x-table.cell>
                    <x-table.cell>₱{{ number_format($record->cost, 2) }}</x-table.cell>
                    <x-table.cell>
                        <span class="px-2 py-1 text-xs rounded-full {{ 
                            $record->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                            ($record->payment_status === 'partially_paid' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') 
                        }}">
                            {{ ucfirst($record->payment_status) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex space-x-2">
                            <a href="{{ route($role . '.treatment-records.show', $record) }}" class="text-blue-500 hover:text-blue-700">
                                View
                            </a>
                            <a href="{{ route($role . '.treatment-records.edit', $record) }}" class="text-yellow-500 hover:text-yellow-700">
                                Edit
                            </a>
                            <form method="POST" action="{{ route($role . '.treatment-records.destroy', $record) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this treatment record?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="7" class="text-center">No treatment records found.</x-table.cell>
                </x-table.row>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $treatmentRecords->links() }}
        </div>
    </x-card>
</x-layout.app> 