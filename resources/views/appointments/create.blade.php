<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule New Appointment') }}
        </h2>
    </x-slot>

    <x-card>
        @php
            $role = auth()->user()->role;
        @endphp
        <form method="POST" action="{{ route($role . '.appointments.store') }}" class="space-y-6">
            @csrf

            <!-- Patient Selection -->
            <x-form.select
                name="patient_id"
                label="Patient"
                :options="$patients->pluck('patient_name', 'patient_id')->toArray()"
                required
            />

            <!-- Dentist Selection -->
            <x-form.select
                name="dentist_id"
                label="Dentist"
                :options="$dentists->pluck('dentist_name', 'dentist_id')->toArray()"
                required
            />

            <!-- Appointment Date and Time -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input
                    type="date"
                    name="appointment_date"
                    label="Date"
                    :min="date('Y-m-d')"
                    required
                />
                <x-form.input
                    type="time"
                    name="appointment_time"
                    label="Time"
                    required
                />
            </div>

            <!-- Purpose of Appointment -->
            <x-form.input
                name="purpose_of_appointment"
                label="Purpose of Appointment"
                placeholder="e.g., Regular Checkup, Tooth Extraction, Cleaning"
                required
            />

            <!-- Notes -->
            <x-form.textarea
                name="notes"
                label="Additional Notes"
                placeholder="Any special instructions or notes for the appointment"
            />

            <!-- Submit Button -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route($role . '.appointments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Schedule Appointment
                </button>
            </div>
        </form>
    </x-card>

    @push('scripts')
    <script>
        // Add any JavaScript for date/time validation or dynamic updates here
    </script>
    @endpush
</x-layout.app> 