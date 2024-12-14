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
        <div class="mb-4 space-y-4">
            <form method="GET" action="{{ route($role . '.appointments.index') }}" class="flex flex-col md:flex-row gap-4">
                <x-form.input 
                    name="search" 
                    label="Search Appointments"
                    value="{{ request('search') }}"
                    placeholder="Search by patient or dentist name..."
                    class="flex-1"
                />
                <x-form.select
                    name="status"
                    label="Status"
                    :value="request('status')"
                    :options="[
                        '' => 'All Statuses',
                        'scheduled' => 'Scheduled',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled'
                    ]"
                    class="flex-1"
                />
                <x-form.input
                    type="date"
                    name="date"
                    label="Date"
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