<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <!-- Today's Appointments Card -->
        <x-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Today's Appointments</p>
                    <p class="text-lg font-semibold">{{ $todayAppointments->count() }}</p>
                </div>
            </div>
        </x-card>

        <!-- Total Patients Card -->
        <x-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Patients</p>
                    <p class="text-lg font-semibold">{{ $totalPatients }}</p>
                </div>
            </div>
        </x-card>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <x-card title="Quick Actions">
            <div class="space-y-4">
                <a href="{{ route('patients.create') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                    Register New Patient
                </a>
                <a href="{{ route('appointments.create') }}" class="block w-full text-center bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                    Schedule Appointment
                </a>
            </div>
        </x-card>

        <!-- Recent Patients -->
        <x-card title="Recent Patients">
            <div class="space-y-4">
                @forelse($recentPatients as $patient)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <p class="font-medium">{{ $patient->patient_name }}</p>
                            <p class="text-sm text-gray-500">Added {{ $patient->created_at->diffForHumans() }}</p>
                        </div>
                        <a href="{{ route('patients.show', $patient) }}" class="text-blue-500 hover:text-blue-700">
                            View Details
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500">No recent patients</p>
                @endforelse
            </div>
        </x-card>
    </div>

    <!-- Today's Schedule -->
    <x-card title="Today's Schedule">
        <div class="space-y-4">
            @forelse($todayAppointments as $appointment)
                <div class="flex items-center justify-between border-b pb-2">
                    <div>
                        <p class="font-medium">{{ $appointment->patient->patient_name }}</p>
                        <div class="text-sm text-gray-500">
                            <p>{{ $appointment->appointment_date->format('h:i A') }}</p>
                            <p>Dr. {{ $appointment->dentist->dentist_name }}</p>
                            <p>{{ $appointment->purpose_of_appointment }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full {{ 
                        $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : 
                        ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
                    }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
            @empty
                <p class="text-gray-500">No appointments scheduled for today</p>
            @endforelse
        </div>
    </x-card>
</x-layout.app> 