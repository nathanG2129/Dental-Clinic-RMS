<x-layout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Treatment Record') }}
        </h2>
    </x-slot>

    <x-card>
        @php
            $role = auth()->user()->role;
        @endphp
        <form method="POST" action="{{ route($role . '.treatment-records.store') }}" class="space-y-6">
            @csrf

            <!-- Patient Selection -->
            <x-form.select
                name="patient_id"
                label="Patient"
                :options="$patients->pluck('patient_name', 'patient_id')->toArray()"
                :value="old('patient_id', request('patient_id'))"
                required
            />

            <!-- Dentist Selection -->
            <x-form.select
                name="dentist_id"
                label="Dentist"
                :options="$dentists->pluck('dentist_name', 'dentist_id')->toArray()"
                :value="old('dentist_id', request('dentist_id'))"
                required
            />

            <!-- Treatment Type -->
            <x-form.input
                name="treatment_type"
                label="Treatment Type"
                placeholder="e.g., Tooth Extraction, Root Canal, Cleaning"
                required
            />

            <!-- Treatment Details -->
            <x-form.textarea
                name="treatment_details"
                label="Treatment Details"
                placeholder="Detailed description of the treatment performed"
                rows="4"
                required
            />

            <!-- Treatment Date -->
            <x-form.input
                type="date"
                name="treatment_date"
                label="Treatment Date"
                :value="old('treatment_date', date('Y-m-d'))"
                :max="date('Y-m-d')"
                required
            />

            <!-- Cost -->
            <x-form.input
                type="number"
                name="cost"
                label="Cost"
                placeholder="0.00"
                step="0.01"
                min="0"
                required
            />

            <!-- Payment Status -->
            <x-form.select
                name="payment_status"
                label="Payment Status"
                :options="[
                    'pending' => 'Pending',
                    'partially_paid' => 'Partially Paid',
                    'paid' => 'Paid'
                ]"
                required
            />

            <!-- Notes -->
            <x-form.textarea
                name="notes"
                label="Additional Notes"
                placeholder="Any additional notes or observations"
                rows="3"
            />

            <!-- Submit Button -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route($role . '.treatment-records.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Create Record
                </button>
            </div>
        </form>
    </x-card>
</x-layout.app> 