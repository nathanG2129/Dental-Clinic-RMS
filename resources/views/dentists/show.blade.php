<x-layout.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dentist Details') }}
            </h2>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('dentists.edit', $dentist) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    Edit Dentist
                </a>
            @endif
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Dentist Information -->
        <x-card title="Dentist Information">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Name</h4>
                    <p class="mt-1">{{ $dentist->dentist_name }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Specialization</h4>
                    <p class="mt-1">{{ $dentist->specialization }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Contact Information</h4>
                    <p class="mt-1">{{ $dentist->contact_information }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Associated User</h4>
                    <p class="mt-1">{{ $dentist->user->name }} ({{ $dentist->user->email }})</p>
                </div>
            </div>
        </x-card>

        <!-- Today's Schedule -->
        <x-card title="Today's Schedule">
            <div class="space-y-4">
                @forelse($dentist->appointments()->whereDate('appointment_date', today())->orderBy('appointment_date')->get() as $appointment)
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
                    <p class="text-gray-500">No appointments scheduled for today.</p>
                @endforelse
            </div>
        </x-card>

        <!-- Recent Treatments -->
        <x-card title="Recent Treatments">
            <div class="space-y-4">
                @forelse($dentist->treatmentRecords()->with('patient')->latest()->take(5)->get() as $treatment)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <p class="font-medium">{{ $treatment->patient->patient_name }}</p>
                            <p class="text-sm text-gray-500">{{ $treatment->treatment_type }}</p>
                            <p class="text-sm text-gray-500">{{ $treatment->treatment_date->format('M d, Y') }}</p>
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
                    <p class="text-gray-500">No recent treatments.</p>
                @endforelse
            </div>
        </x-card>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-card>
                <div class="text-center">
                    <h4 class="text-sm font-medium text-gray-500">Total Patients</h4>
                    <p class="mt-2 text-3xl font-semibold">{{ $dentist->appointments()->distinct('patient_id')->count() }}</p>
                </div>
            </x-card>

            <x-card>
                <div class="text-center">
                    <h4 class="text-sm font-medium text-gray-500">Total Appointments</h4>
                    <p class="mt-2 text-3xl font-semibold">{{ $dentist->appointments()->count() }}</p>
                </div>
            </x-card>

            <x-card>
                <div class="text-center">
                    <h4 class="text-sm font-medium text-gray-500">Total Treatments</h4>
                    <p class="mt-2 text-3xl font-semibold">{{ $dentist->treatmentRecords()->count() }}</p>
                </div>
            </x-card>
        </div>
    </div>
</x-layout.app> 