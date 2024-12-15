<x-layout.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Appointment Details') }}
            </h2>
            @php
                $role = auth()->user()->role;
            @endphp
            @if($appointment->status === 'scheduled')
                <div class="flex space-x-2">
                    <a href="{{ route($role . '.appointments.edit', $appointment) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                        Edit Appointment
                    </a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Appointment Information -->
        <x-card title="Appointment Information">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Patient</h4>
                    <p class="mt-1">{{ $appointment->patient->patient_name }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Dentist</h4>
                    <p class="mt-1">Dr. {{ $appointment->dentist->dentist_name }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Date & Time</h4>
                    <p class="mt-1">{{ $appointment->appointment_date->format('M d, Y h:i A') }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Status</h4>
                    <p class="mt-1">
                        <span class="px-2 py-1 text-xs rounded-full {{ 
                            $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : 
                            ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
                        }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </p>
                </div>
                <div class="md:col-span-2">
                    <h4 class="text-sm font-medium text-gray-500">Purpose of Appointment</h4>
                    <p class="mt-1">{{ $appointment->purpose_of_appointment }}</p>
                </div>
                @if($appointment->notes)
                    <div class="md:col-span-2">
                        <h4 class="text-sm font-medium text-gray-500">Additional Notes</h4>
                        <p class="mt-1">{{ $appointment->notes }}</p>
                    </div>
                @endif
            </div>
        </x-card>

        <!-- Actions -->
        @if($appointment->status === 'scheduled')
            <x-card title="Actions">
                <div class="space-y-4">
                    <form method="POST" action="{{ route($role . '.appointments.update', $appointment) }}" class="mb-4">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to mark this appointment as completed?')">
                            Mark as Completed
                        </button>
                    </form>

                    <form method="POST" action="{{ route($role . '.appointments.update', $appointment) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                            Cancel Appointment
                        </button>
                    </form>
                </div>
            </x-card>
        @endif
    </div>
</x-layout.app> 