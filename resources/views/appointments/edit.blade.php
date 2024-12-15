&lt;x-layout.app&gt;
    &lt;x-slot name="header"&gt;
        &lt;h2 class="font-semibold text-xl text-gray-800 leading-tight"&gt;
            {{ __('Edit Appointment') }}
        &lt;/h2&gt;
    &lt;/x-slot&gt;

    &lt;x-card&gt;
        &lt;form method="POST" action="{{ route(auth()->user()->role . '.appointments.update', $appointment) }}" class="space-y-6"&gt;
            @csrf
            @method('PUT')

            &lt;!-- Patient Selection --&gt;
            &lt;x-form.select
                name="patient_id"
                label="Patient"
                :options="$patients-&gt;pluck('patient_name', 'patient_id')-&gt;toArray()"
                :value="$appointment-&gt;patient_id"
                required
            /&gt;

            &lt;!-- Dentist Selection --&gt;
            &lt;x-form.select
                name="dentist_id"
                label="Dentist"
                :options="$dentists-&gt;pluck('dentist_name', 'dentist_id')-&gt;toArray()"
                :value="$appointment-&gt;dentist_id"
                required
            /&gt;

            &lt;!-- Appointment Date and Time --&gt;
            &lt;div class="grid grid-cols-1 md:grid-cols-2 gap-4"&gt;
                &lt;x-form.input
                    type="date"
                    name="appointment_date"
                    label="Date"
                    :value="$appointment-&gt;appointment_date-&gt;format('Y-m-d')"
                    :min="date('Y-m-d')"
                    required
                /&gt;
                &lt;x-form.input
                    type="time"
                    name="appointment_time"
                    label="Time"
                    :value="$appointment-&gt;appointment_date-&gt;format('H:i')"
                    required
                /&gt;
            &lt;/div&gt;

            &lt;!-- Purpose of Appointment --&gt;
            &lt;x-form.input
                name="purpose_of_appointment"
                label="Purpose of Appointment"
                :value="$appointment-&gt;purpose_of_appointment"
                placeholder="e.g., Regular Checkup, Tooth Extraction, Cleaning"
                required
            /&gt;

            &lt;!-- Notes --&gt;
            &lt;x-form.textarea
                name="notes"
                label="Additional Notes"
                :value="$appointment-&gt;notes"
                placeholder="Any special instructions or notes for the appointment"
            /&gt;

            &lt;!-- Status --&gt;
            &lt;x-form.select
                name="status"
                label="Status"
                :options="[
                    'scheduled' =&gt; 'Scheduled',
                    'completed' =&gt; 'Completed',
                    'cancelled' =&gt; 'Cancelled'
                ]"
                :value="$appointment-&gt;status"
                required
            /&gt;

            &lt;!-- Submit Button --&gt;
            &lt;div class="flex justify-end space-x-2"&gt;
                &lt;a href="{{ route(auth()->user()->role . '.appointments.show', $appointment) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded"&gt;
                    Cancel
                &lt;/a&gt;
                &lt;button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"&gt;
                    Update Appointment
                &lt;/button&gt;
            &lt;/div&gt;
        &lt;/form&gt;
    &lt;/x-card&gt;

    @push('scripts')
    &lt;script&gt;
        // Add any JavaScript for date/time validation or dynamic updates here
    &lt;/script&gt;
    @endpush
&lt;/x-layout.app&gt; 