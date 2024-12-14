<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Patient') }}
        </h2>
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('patients.update', $patient) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Patient Name -->
            <x-form.input
                name="patient_name"
                label="Patient Name"
                :value="$patient->patient_name"
                required
            />

            <!-- Date of Birth -->
            <x-form.input
                type="date"
                name="date_of_birth"
                label="Date of Birth"
                :value="$patient->date_of_birth->format('Y-m-d')"
                required
            />

            <!-- Gender -->
            <x-form.select
                name="gender"
                label="Gender"
                :options="[
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other'
                ]"
                :value="$patient->gender"
                required
            />

            <!-- Contact Information -->
            <x-form.input
                name="contact_information"
                label="Contact Information"
                :value="$patient->contact_information"
                placeholder="Phone number or email"
                required
            />

            <!-- Address -->
            <x-form.textarea
                name="address"
                label="Address"
                :value="$patient->address"
                rows="3"
                required
            />

            <!-- Submit Button -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('patients.show', $patient) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Update Patient
                </button>
            </div>
        </form>
    </x-card>
</x-layout.app> 