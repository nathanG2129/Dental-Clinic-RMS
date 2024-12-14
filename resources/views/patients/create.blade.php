<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Patient') }}
        </h2>
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('patients.store') }}" class="space-y-6">
            @csrf

            <!-- Patient Name -->
            <x-form.input
                name="patient_name"
                label="Patient Name"
                required
            />

            <!-- Date of Birth -->
            <x-form.input
                type="date"
                name="date_of_birth"
                label="Date of Birth"
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
                required
            />

            <!-- Contact Information -->
            <x-form.input
                name="contact_information"
                label="Contact Information"
                placeholder="Phone number or email"
                required
            />

            <!-- Address -->
            <x-form.textarea
                name="address"
                label="Address"
                rows="3"
                required
            />

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Create Patient
                </button>
            </div>
        </form>
    </x-card>
</x-layout.app> 