&lt;x-layout.app&gt;
    &lt;x-slot name="header"&gt;
        &lt;div class="flex justify-between items-center"&gt;
            &lt;h2 class="font-semibold text-xl text-gray-800 leading-tight"&gt;
                {{ __('Treatment Records') }}
            &lt;/h2&gt;
            &lt;a href="{{ route('treatment-records.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"&gt;
                Add Treatment Record
            &lt;/a&gt;
        &lt;/div&gt;
    &lt;/x-slot&gt;

    &lt;x-card&gt;
        &lt;!-- Search and Filters --&gt;
        &lt;div class="mb-4 space-y-4"&gt;
            &lt;form method="GET" action="{{ route('treatment-records.index') }}" class="flex flex-col md:flex-row gap-4"&gt;
                &lt;x-form.input 
                    name="search" 
                    label="Search Records"
                    value="{{ request('search') }}"
                    placeholder="Search by patient or treatment type..."
                    class="flex-1"
                /&gt;
                &lt;x-form.select
                    name="payment_status"
                    label="Payment Status"
                    :value="request('payment_status')"
                    :options="[
                        '' =&gt; 'All Statuses',
                        'pending' =&gt; 'Pending',
                        'partially_paid' =&gt; 'Partially Paid',
                        'paid' =&gt; 'Paid'
                    ]"
                    class="flex-1"
                /&gt;
                &lt;x-form.input
                    type="date"
                    name="date"
                    label="Treatment Date"
                    value="{{ request('date') }}"
                    class="flex-1"
                /&gt;
                &lt;div class="flex items-end"&gt;
                    &lt;button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded"&gt;
                        Search
                    &lt;/button&gt;
                &lt;/div&gt;
            &lt;/form&gt;
        &lt;/div&gt;

        &lt;!-- Treatment Records Table --&gt;
        &lt;x-table.table :headers="['Date', 'Patient', 'Dentist', 'Treatment', 'Cost', 'Payment Status', 'Actions']"&gt;
            @forelse($treatmentRecords as $record)
                &lt;x-table.row :striped="$loop-&gt;even"&gt;
                    &lt;x-table.cell&gt;{{ $record-&gt;treatment_date-&gt;format('M d, Y') }}&lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;{{ $record-&gt;patient-&gt;patient_name }}&lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;{{ $record-&gt;dentist-&gt;dentist_name }}&lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;{{ $record-&gt;treatment_type }}&lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;₱{{ number_format($record-&gt;cost, 2) }}&lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;
                        &lt;span class="px-2 py-1 text-xs rounded-full {{ 
                            $record-&gt;payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                            ($record-&gt;payment_status === 'partially_paid' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') 
                        }}"&gt;
                            {{ ucfirst($record-&gt;payment_status) }}
                        &lt;/span&gt;
                    &lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;
                        &lt;div class="flex space-x-2"&gt;
                            &lt;a href="{{ route('treatment-records.show', $record) }}" class="text-blue-500 hover:text-blue-700"&gt;
                                View
                            &lt;/a&gt;
                            &lt;a href="{{ route('treatment-records.edit', $record) }}" class="text-yellow-500 hover:text-yellow-700"&gt;
                                Edit
                            &lt;/a&gt;
                            &lt;form method="POST" action="{{ route('treatment-records.destroy', $record) }}" class="inline"&gt;
                                @csrf
                                @method('DELETE')
                                &lt;button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this treatment record?')"&gt;
                                    Delete
                                &lt;/button&gt;
                            &lt;/form&gt;
                        &lt;/div&gt;
                    &lt;/x-table.cell&gt;
                &lt;/x-table.row&gt;
            @empty
                &lt;x-table.row&gt;
                    &lt;x-table.cell colspan="7" class="text-center"&gt;No treatment records found.&lt;/x-table.cell&gt;
                &lt;/x-table.row&gt;
            @endforelse
        &lt;/x-table.table&gt;

        &lt;!-- Pagination --&gt;
        &lt;div class="mt-4"&gt;
            {{ $treatmentRecords-&gt;links() }}
        &lt;/div&gt;
    &lt;/x-card&gt;
&lt;/x-layout.app&gt; 