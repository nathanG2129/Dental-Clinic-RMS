&lt;x-layout.app&gt;
    &lt;x-slot name="header"&gt;
        &lt;div class="flex justify-between items-center"&gt;
            &lt;h2 class="font-semibold text-xl text-gray-800 leading-tight"&gt;
                {{ __('Appointments') }}
            &lt;/h2&gt;
            &lt;a href="{{ route('appointments.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"&gt;
                Schedule New Appointment
            &lt;/a&gt;
        &lt;/div&gt;
    &lt;/x-slot&gt;

    &lt;x-card&gt;
        &lt;!-- Search and Filters --&gt;
        &lt;div class="mb-4 space-y-4"&gt;
            &lt;form method="GET" action="{{ route('appointments.index') }}" class="flex flex-col md:flex-row gap-4"&gt;
                &lt;x-form.input 
                    name="search" 
                    label="Search Appointments"
                    value="{{ request('search') }}"
                    placeholder="Search by patient or dentist name..."
                    class="flex-1"
                /&gt;
                &lt;x-form.select
                    name="status"
                    label="Status"
                    :value="request('status')"
                    :options="[
                        '' =&gt; 'All Statuses',
                        'scheduled' =&gt; 'Scheduled',
                        'completed' =&gt; 'Completed',
                        'cancelled' =&gt; 'Cancelled'
                    ]"
                    class="flex-1"
                /&gt;
                &lt;x-form.input
                    type="date"
                    name="date"
                    label="Date"
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

        &lt;!-- Appointments Table --&gt;
        &lt;x-table.table :headers="['Date &amp; Time', 'Patient', 'Dentist', 'Purpose', 'Status', 'Actions']"&gt;
            @forelse($appointments as $appointment)
                &lt;x-table.row :striped="$loop-&gt;even"&gt;
                    &lt;x-table.cell&gt;{{ $appointment-&gt;appointment_date-&gt;format('M d, Y h:i A') }}&lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;{{ $appointment-&gt;patient-&gt;patient_name }}&lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;{{ $appointment-&gt;dentist-&gt;dentist_name }}&lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;{{ $appointment-&gt;purpose_of_appointment }}&lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;
                        &lt;span class="px-2 py-1 text-xs rounded-full {{ 
                            $appointment-&gt;status === 'completed' ? 'bg-green-100 text-green-800' : 
                            ($appointment-&gt;status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
                        }}"&gt;
                            {{ ucfirst($appointment-&gt;status) }}
                        &lt;/span&gt;
                    &lt;/x-table.cell&gt;
                    &lt;x-table.cell&gt;
                        &lt;div class="flex space-x-2"&gt;
                            &lt;a href="{{ route('appointments.show', $appointment) }}" class="text-blue-500 hover:text-blue-700"&gt;
                                View
                            &lt;/a&gt;
                            @if($appointment-&gt;status === 'scheduled')
                                &lt;a href="{{ route('appointments.edit', $appointment) }}" class="text-yellow-500 hover:text-yellow-700"&gt;
                                    Edit
                                &lt;/a&gt;
                                &lt;form method="POST" action="{{ route('appointments.destroy', $appointment) }}" class="inline"&gt;
                                    @csrf
                                    @method('DELETE')
                                    &lt;button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to cancel this appointment?')"&gt;
                                        Cancel
                                    &lt;/button&gt;
                                &lt;/form&gt;
                            @endif
                        &lt;/div&gt;
                    &lt;/x-table.cell&gt;
                &lt;/x-table.row&gt;
            @empty
                &lt;x-table.row&gt;
                    &lt;x-table.cell colspan="6" class="text-center"&gt;No appointments found.&lt;/x-table.cell&gt;
                &lt;/x-table.row&gt;
            @endforelse
        &lt;/x-table.table&gt;

        &lt;!-- Pagination --&gt;
        &lt;div class="mt-4"&gt;
            {{ $appointments-&gt;links() }}
        &lt;/div&gt;
    &lt;/x-card&gt;
&lt;/x-layout.app&gt; 