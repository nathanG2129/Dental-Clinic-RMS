<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Dentist') }}
        </h2>
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('dentists.store') }}" class="space-y-6">
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

            <!-- Associated User Account -->
            <x-form.select
                name="user_id"
                label="Associated User Account"
                :options="$users->pluck('name', 'id')->toArray()"
                required
            />

            <!-- Submit Button -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('dentists.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Create Dentist
                </button>
            </div>
        </form>
    </x-card>
</x-layout.app> 