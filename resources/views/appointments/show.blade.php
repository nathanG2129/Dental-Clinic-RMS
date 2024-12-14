&lt;x-layout.app&gt;
    &lt;x-slot name="header"&gt;
        &lt;div class="flex justify-between items-center"&gt;
            &lt;h2 class="font-semibold text-xl text-gray-800 leading-tight"&gt;
                {{ __('Appointment Details') }}
            &lt;/h2&gt;
            @if($appointment-&gt;status === 'scheduled')
                &lt;div class="flex space-x-2"&gt;
                    &lt;a href="{{ route('appointments.edit', $appointment) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded"&gt;
                        Edit Appointment
                    &lt;/a&gt;
                &lt;/div&gt;
            @endif
        &lt;/div&gt;
    &lt;/x-slot&gt;

    &lt;div class="space-y-6"&gt;
        &lt;!-- Appointment Information --&gt;
        &lt;x-card&gt;
            &lt;div class="grid grid-cols-1 md:grid-cols-2 gap-6"&gt;
                &lt;div&gt;
                    &lt;h3 class="text-lg font-medium text-gray-900 mb-4"&gt;Appointment Details&lt;/h3&gt;
                    &lt;dl class="space-y-2"&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Date &amp; Time&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $appointment-&gt;appointment_date-&gt;format('F d, Y h:i A') }}&lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Purpose&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $appointment-&gt;purpose_of_appointment }}&lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Status&lt;/dt&gt;
                            &lt;dd class="mt-1"&gt;
                                &lt;span class="px-2 py-1 text-xs rounded-full {{ 
                                    $appointment-&gt;status === 'completed' ? 'bg-green-100 text-green-800' : 
                                    ($appointment-&gt;status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
                                }}"&gt;
                                    {{ ucfirst($appointment-&gt;status) }}
                                &lt;/span&gt;
                            &lt;/dd&gt;
                        &lt;/div&gt;
                        @if($appointment-&gt;notes)
                            &lt;div&gt;
                                &lt;dt class="text-sm font-medium text-gray-500"&gt;Notes&lt;/dt&gt;
                                &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $appointment-&gt;notes }}&lt;/dd&gt;
                            &lt;/div&gt;
                        @endif
                    &lt;/dl&gt;
                &lt;/div&gt;

                &lt;div&gt;
                    &lt;h3 class="text-lg font-medium text-gray-900 mb-4"&gt;People Involved&lt;/h3&gt;
                    &lt;dl class="space-y-4"&gt;
                        &lt;div class="border-b pb-4"&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Patient&lt;/dt&gt;
                            &lt;dd class="mt-1"&gt;
                                &lt;div class="text-sm text-gray-900"&gt;{{ $appointment-&gt;patient-&gt;patient_name }}&lt;/div&gt;
                                &lt;div class="text-sm text-gray-500"&gt;
                                    Contact: {{ $appointment-&gt;patient-&gt;contact_number }}
                                &lt;/div&gt;
                            &lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Dentist&lt;/dt&gt;
                            &lt;dd class="mt-1"&gt;
                                &lt;div class="text-sm text-gray-900"&gt;{{ $appointment-&gt;dentist-&gt;dentist_name }}&lt;/div&gt;
                                &lt;div class="text-sm text-gray-500"&gt;
                                    Specialization: {{ $appointment-&gt;dentist-&gt;specialization }}
                                &lt;/div&gt;
                            &lt;/dd&gt;
                        &lt;/div&gt;
                    &lt;/dl&gt;
                &lt;/div&gt;
            &lt;/div&gt;

            @if($appointment-&gt;status === 'scheduled')
                &lt;div class="mt-6 border-t pt-4"&gt;
                    &lt;h3 class="text-lg font-medium text-gray-900 mb-4"&gt;Actions&lt;/h3&gt;
                    &lt;div class="flex space-x-4"&gt;
                        &lt;form method="POST" action="{{ route('appointments.update', $appointment) }}" class="inline"&gt;
                            @csrf
                            @method('PUT')
                            &lt;input type="hidden" name="status" value="completed"&gt;
                            &lt;button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"&gt;
                                Mark as Completed
                            &lt;/button&gt;
                        &lt;/form&gt;
                        &lt;form method="POST" action="{{ route('appointments.update', $appointment) }}" class="inline"&gt;
                            @csrf
                            @method('PUT')
                            &lt;input type="hidden" name="status" value="cancelled"&gt;
                            &lt;button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to cancel this appointment?')"&gt;
                                Cancel Appointment
                            &lt;/button&gt;
                        &lt;/form&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            @endif
        &lt;/x-card&gt;

        @if($appointment-&gt;status === 'completed')
            &lt;!-- Treatment Records --&gt;
            &lt;x-card&gt;
                &lt;div class="flex justify-between items-center mb-4"&gt;
                    &lt;h3 class="text-lg font-medium text-gray-900"&gt;Treatment Records&lt;/h3&gt;
                    &lt;a href="{{ route('treatment-records.create', ['appointment_id' =&gt; $appointment-&gt;appointment_id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"&gt;
                        Add Treatment Record
                    &lt;/a&gt;
                &lt;/div&gt;

                &lt;x-table.table :headers="['Date', 'Treatment Type', 'Description', 'Cost', 'Payment Status', 'Actions']"&gt;
                    @forelse($appointment-&gt;treatmentRecords as $record)
                        &lt;x-table.row :striped="$loop-&gt;even"&gt;
                            &lt;x-table.cell&gt;{{ $record-&gt;treatment_date-&gt;format('M d, Y') }}&lt;/x-table.cell&gt;
                            &lt;x-table.cell&gt;{{ $record-&gt;treatment_type }}&lt;/x-table.cell&gt;
                            &lt;x-table.cell&gt;{{ Str::limit($record-&gt;description, 50) }}&lt;/x-table.cell&gt;
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
                                &lt;a href="{{ route('treatment-records.show', $record) }}" class="text-blue-500 hover:text-blue-700"&gt;
                                    View
                                &lt;/a&gt;
                            &lt;/x-table.cell&gt;
                        &lt;/x-table.row&gt;
                    @empty
                        &lt;x-table.row&gt;
                            &lt;x-table.cell colspan="6" class="text-center"&gt;No treatment records found.&lt;/x-table.cell&gt;
                        &lt;/x-table.row&gt;
                    @endforelse
                &lt;/x-table.table&gt;
            &lt;/x-card&gt;
        @endif
    &lt;/div&gt;
&lt;/x-layout.app&gt; 