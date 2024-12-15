<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Appointment') }}
        </h2>
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route(auth()->user()->role . '.appointments.update', $appointment) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Patient Selection -->
            <x-form.select
                name="patient_id"
                label="Patient"
                :options="$patients->pluck('patient_name', 'patient_id')->toArray()"
                :value="$appointment->patient_id"
                required
            />

            <!-- Dentist Selection -->
            <x-form.select
                name="dentist_id"
                label="Dentist"
                :options="$dentists->pluck('dentist_name', 'dentist_id')->toArray()"
                :value="$appointment->dentist_id"
                required
            />

            <!-- Appointment Date and Time -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input
                    type="date"
                    name="appointment_date"
                    label="Date"
                    :value="$appointment->appointment_date->format('Y-m-d')"
                    :min="date('Y-m-d')"
                    required
                />
                <x-form.input
                    type="time"
                    name="appointment_time"
                    label="Time"
                    :value="$appointment->appointment_date->format('H:i')"
                    required
                />
            </div>

            <!-- Purpose of Appointment -->
            <x-form.input
                name="purpose_of_appointment"
                label="Purpose of Appointment"
                :value="$appointment->purpose_of_appointment"
                placeholder="e.g., Regular Checkup, Tooth Extraction, Cleaning"
                required
            />

            <!-- Notes -->
            <x-form.textarea
                name="notes"
                label="Additional Notes"
                :value="$appointment->notes"
                placeholder="Any special instructions or notes for the appointment"
            />

            <!-- Status -->
            <x-form.select
                name="status"
                label="Status"
                :options="[
                    'scheduled' => 'Scheduled',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled'
                ]"
                :value="$appointment->status"
                required
            />

            <!-- Submit Button -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route(auth()->user()->role . '.appointments.show', $appointment) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Update Appointment
                </button>
            </div>
        </form>
    </x-card>
</x-layout.app> 