<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dentist Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
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
                    <p class="text-sm text-gray-500">My Patients</p>
                    <p class="text-lg font-semibold">{{ $totalPatients }}</p>
                </div>
            </div>
        </x-card>

        <!-- Completed Treatments Card -->
        <x-card>
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Completed Treatments</p>
                    <p class="text-lg font-semibold">{{ $completedTreatments }}</p>
                </div>
            </div>
        </x-card>
    </div>

    <!-- Today's Schedule -->
    <x-card title="Today's Schedule" class="mb-6">
        <div class="space-y-4">
            @forelse($todayAppointments as $appointment)
                <div class="flex items-center justify-between border-b pb-2">
                    <div>
                        <p class="font-medium">{{ $appointment->patient->patient_name }}</p>
                        <p class="text-sm text-gray-500">{{ $appointment->appointment_date->format('h:i A') }} - {{ $appointment->purpose_of_appointment }}</p>
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

    <!-- Recent Treatments -->
    <x-card title="Recent Treatments">
        <div class="space-y-4">
            @forelse($recentTreatments as $treatment)
                <div class="flex items-center justify-between border-b pb-2">
                    <div>
                        <p class="font-medium">{{ $treatment->patient->patient_name }}</p>
                        <p class="text-sm text-gray-500">{{ $treatment->treatment_type }} - {{ $treatment->treatment_date->format('M d, Y') }}</p>
                    </div>
                    <a href="{{ route('dentist.treatment-records.show', $treatment) }}" class="text-blue-500 hover:text-blue-700">
                        View Details
                    </a>
                </div>
            @empty
                <p class="text-gray-500">No recent treatments</p>
            @endforelse
        </div>
    </x-card>
</x-layout.app> 