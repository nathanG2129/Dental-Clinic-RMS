<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Dentist') }}
        </h2>
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('dentists.update', $dentist) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Dentist Name -->
            <x-form.input
                name="dentist_name"
                label="Dentist Name"
                :value="$dentist->dentist_name"
                required
            />

            <!-- Specialization -->
            <x-form.input
                name="specialization"
                label="Specialization"
                :value="$dentist->specialization"
                required
            />

            <!-- Contact Information -->
            <x-form.input
                name="contact_information"
                label="Contact Information"
                :value="$dentist->contact_information"
                placeholder="Phone number or email"
                required
            />

            <!-- Associated User Account -->
            <x-form.select
                name="user_id"
                label="Associated User Account"
                :options="$users->pluck('name', 'id')->toArray()"
                :value="$dentist->user_id"
                required
            />

            <!-- Submit Button -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('dentists.show', $dentist) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Update Dentist
                </button>
            </div>
        </form>
    </x-card>
</x-layout.app> 