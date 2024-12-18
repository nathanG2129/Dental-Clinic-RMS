<x-layout.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Appointments') }}
            </h2>
            @php
                $role = auth()->user()->role;
            @endphp
            <a href="{{ route($role . '.appointments.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Schedule New Appointment
            </a>
        </div>
    </x-slot>

    <x-card>
        <!-- Search and Filters -->
        <div class="mb-6">
            <form method="GET" action="{{ route($role . '.appointments.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <input type="text" name="search" id="search" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Search by patient or dentist name..."
                            value="{{ request('search') }}">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">All Statuses</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="purpose" class="block text-sm font-medium text-gray-700 mb-1">Purpose</label>
                        <input type="text" name="purpose" id="purpose" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Filter by purpose..."
                            value="{{ request('purpose') }}">
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
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                            <input type="time" name="start_time" id="start_time" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ request('start_time') }}">
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                            <input type="time" name="end_time" id="end_time" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                value="{{ request('end_time') }}">
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

        <!-- Appointments Table -->
        <x-table.table :headers="['Date & Time', 'Patient', 'Dentist', 'Purpose', 'Status', 'Actions']">
            @forelse($appointments as $appointment)
                <x-table.row :striped="$loop->even">
                    <x-table.cell>{{ $appointment->appointment_date->format('M d, Y h:i A') }}</x-table.cell>
                    <x-table.cell>{{ $appointment->patient->patient_name }}</x-table.cell>
                    <x-table.cell>{{ $appointment->dentist->dentist_name }}</x-table.cell>
                    <x-table.cell>{{ $appointment->purpose_of_appointment }}</x-table.cell>
                    <x-table.cell>
                        <span class="px-2 py-1 text-xs rounded-full {{ 
                            $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : 
                            ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
                        }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex space-x-2">
                            <a href="{{ route($role . '.appointments.show', $appointment) }}" class="text-blue-500 hover:text-blue-700">
                                View
                            </a>
                            @if($appointment->status === 'scheduled')
                                <a href="{{ route($role . '.appointments.edit', $appointment) }}" class="text-yellow-500 hover:text-yellow-700">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route($role . '.appointments.destroy', $appointment) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                        Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="6" class="text-center">No appointments found.</x-table.cell>
                </x-table.row>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    </x-card>
</x-layout.app> 