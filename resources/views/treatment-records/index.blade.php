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
        <div class="mb-4 space-y-4">
            <form method="GET" action="{{ route($indexRoute) }}" class="flex flex-col md:flex-row gap-4">
                <x-form.input 
                    name="search" 
                    label="Search Records"
                    value="{{ request('search') }}"
                    placeholder="Search by patient or treatment type..."
                    class="flex-1"
                />
                <x-form.select
                    name="payment_status"
                    label="Payment Status"
                    :value="request('payment_status')"
                    :options="[
                        '' => 'All Statuses',
                        'pending' => 'Pending',
                        'partially_paid' => 'Partially Paid',
                        'paid' => 'Paid'
                    ]"
                    class="flex-1"
                />
                <x-form.input
                    type="date"
                    name="date"
                    label="Treatment Date"
                    value="{{ request('date') }}"
                    class="flex-1"
                />
                <div class="flex items-end">
                    <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Search
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