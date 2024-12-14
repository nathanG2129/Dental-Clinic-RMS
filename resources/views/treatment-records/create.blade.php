&lt;x-layout.app&gt;
    &lt;x-slot name="header"&gt;
        &lt;h2 class="font-semibold text-xl text-gray-800 leading-tight"&gt;
            {{ __('Add Treatment Record') }}
        &lt;/h2&gt;
    &lt;/x-slot&gt;

    &lt;x-card&gt;
        &lt;form method="POST" action="{{ route('treatment-records.store') }}" class="space-y-6"&gt;
            @csrf

            &lt;!-- Patient Selection --&gt;
            &lt;x-form.select
                name="patient_id"
                label="Patient"
                :options="$patients-&gt;pluck('patient_name', 'patient_id')-&gt;toArray()"
                :value="old('patient_id', request('patient_id'))"
                required
            /&gt;

            &lt;!-- Dentist Selection --&gt;
            &lt;x-form.select
                name="dentist_id"
                label="Dentist"
                :options="$dentists-&gt;pluck('dentist_name', 'dentist_id')-&gt;toArray()"
                :value="old('dentist_id', request('dentist_id'))"
                required
            /&gt;

            &lt;!-- Treatment Type --&gt;
            &lt;x-form.input
                name="treatment_type"
                label="Treatment Type"
                placeholder="e.g., Tooth Extraction, Root Canal, Cleaning"
                required
            /&gt;

            &lt;!-- Treatment Details --&gt;
            &lt;x-form.textarea
                name="treatment_details"
                label="Treatment Details"
                placeholder="Detailed description of the treatment performed"
                rows="4"
                required
            /&gt;

            &lt;!-- Treatment Date --&gt;
            &lt;x-form.input
                type="date"
                name="treatment_date"
                label="Treatment Date"
                :value="old('treatment_date', date('Y-m-d'))"
                :max="date('Y-m-d')"
                required
            /&gt;

            &lt;!-- Cost --&gt;
            &lt;x-form.input
                type="number"
                name="cost"
                label="Cost"
                placeholder="0.00"
                step="0.01"
                min="0"
                required
            /&gt;

            &lt;!-- Payment Status --&gt;
            &lt;x-form.select
                name="payment_status"
                label="Payment Status"
                :options="[
                    'pending' =&gt; 'Pending',
                    'partially_paid' =&gt; 'Partially Paid',
                    'paid' =&gt; 'Paid'
                ]"
                required
            /&gt;

            &lt;!-- Notes --&gt;
            &lt;x-form.textarea
                name="notes"
                label="Additional Notes"
                placeholder="Any additional notes or observations"
                rows="3"
            /&gt;

            &lt;!-- Submit Button --&gt;
            &lt;div class="flex justify-end space-x-2"&gt;
                &lt;a href="{{ route('treatment-records.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded"&gt;
                    Cancel
                &lt;/a&gt;
                &lt;button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"&gt;
                    Create Record
                &lt;/button&gt;
            &lt;/div&gt;
        &lt;/form&gt;
    &lt;/x-card&gt;
&lt;/x-layout.app&gt; 