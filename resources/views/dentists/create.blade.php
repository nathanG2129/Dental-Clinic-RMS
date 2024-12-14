<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Dentist') }}
        </h2>
    </x-slot>

    <x-card>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Note: New dentists should register through the registration page. This form is only for updating existing dentist information.
                    </p>
                </div>
            </div>
        </div>

        @php
            $role = auth()->user()->role;
        @endphp
        <form method="POST" action="{{ route($role . '.dentists.store') }}" class="space-y-6">
            @csrf

            <!-- Dentist Name -->
            <x-form.input
                name="dentist_name"
                label="Dentist Name"
                required
            />

            <!-- Specialization -->
            <x-form.input
                name="specialization"
                label="Specialization"
                required
            />

            <!-- Contact Information -->
            <x-form.input
                name="contact_information"
                label="Contact Information"
                placeholder="Phone number or email"
                required
            />

            <!-- Submit Button -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route($role . '.dentists.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Create Dentist
                </button>
            </div>
        </form>
    </x-card>
</x-layout.app> 