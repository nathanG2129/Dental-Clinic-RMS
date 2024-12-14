<x-layout.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Patient Details') }}
            </h2>
            @php
                $role = auth()->user()->role;
            @endphp
            @if($role !== 'dentist')
                <a href="{{ route($role . '.patients.edit', $patient) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    Edit Patient
                </a>
            @endif
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Patient Information -->
        <x-card title="Patient Information">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Name</h4>
                    <p class="mt-1">{{ $patient->patient_name }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Date of Birth</h4>
                    <p class="mt-1">{{ $patient->date_of_birth->format('M d, Y') }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Gender</h4>
                    <p class="mt-1">{{ ucfirst($patient->gender) }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Contact Information</h4>
                    <p class="mt-1">{{ $patient->contact_information }}</p>
                </div>
                <div class="md:col-span-2">
                    <h4 class="text-sm font-medium text-gray-500">Address</h4>
                    <p class="mt-1">{{ $patient->address }}</p>
                </div>
            </div>
        </x-card>

        <!-- Appointments -->
        <x-card title="Appointments">
            <div class="space-y-4">
                @if($role !== 'dentist')
                    <div class="mb-4">
                        <a href="{{ route($role . '.appointments.create', ['patient_id' => $patient->patient_id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Schedule New Appointment
                        </a>
                    </div>
                @endif

                @forelse($patient->appointments()->latest()->get() as $appointment)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <p class="font-medium">{{ $appointment->appointment_date->format('M d, Y h:i A') }}</p>
                            <p class="text-sm text-gray-500">Dr. {{ $appointment->dentist->dentist_name }}</p>
                            <p class="text-sm text-gray-500">{{ $appointment->purpose_of_appointment }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full {{ 
                            $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : 
                            ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
                        }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500">No appointments found.</p>
                @endforelse
            </div>
        </x-card>

        <!-- Treatment History -->
        <x-card title="Treatment History">
            <div class="space-y-4">
                @forelse($patient->treatmentRecords()->latest()->get() as $treatment)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <p class="font-medium">{{ $treatment->treatment_type }}</p>
                            <p class="text-sm text-gray-500">{{ $treatment->treatment_date->format('M d, Y') }}</p>
                            <p class="text-sm text-gray-500">Dr. {{ $treatment->dentist->dentist_name }}</p>
                            <p class="text-sm">{{ $treatment->treatment_details }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium">₱{{ number_format($treatment->cost, 2) }}</p>
                            <span class="px-2 py-1 text-xs rounded-full {{ 
                                $treatment->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                                ($treatment->payment_status === 'partially_paid' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') 
                            }}">
                                {{ ucfirst($treatment->payment_status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No treatment records found.</p>
                @endforelse
            </div>
        </x-card>
    </div>
</x-layout.app> 