&lt;x-layout.app&gt;
    &lt;x-slot name="header"&gt;
        &lt;div class="flex justify-between items-center"&gt;
            &lt;h2 class="font-semibold text-xl text-gray-800 leading-tight"&gt;
                {{ __('Treatment Record Details') }}
            &lt;/h2&gt;
            &lt;div class="flex space-x-2"&gt;
                &lt;a href="{{ route('treatment-records.edit', $treatmentRecord) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded"&gt;
                    Edit Record
                &lt;/a&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/x-slot&gt;

    &lt;div class="space-y-6"&gt;
        &lt;!-- Treatment Information --&gt;
        &lt;x-card&gt;
            &lt;div class="grid grid-cols-1 md:grid-cols-2 gap-6"&gt;
                &lt;div&gt;
                    &lt;h3 class="text-lg font-medium text-gray-900 mb-4"&gt;Treatment Details&lt;/h3&gt;
                    &lt;dl class="space-y-3"&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Treatment Type&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $treatmentRecord-&gt;treatment_type }}&lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Treatment Date&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $treatmentRecord-&gt;treatment_date-&gt;format('F d, Y') }}&lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Treatment Details&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $treatmentRecord-&gt;treatment_details }}&lt;/dd&gt;
                        &lt;/div&gt;
                        @if($treatmentRecord-&gt;notes)
                            &lt;div&gt;
                                &lt;dt class="text-sm font-medium text-gray-500"&gt;Additional Notes&lt;/dt&gt;
                                &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $treatmentRecord-&gt;notes }}&lt;/dd&gt;
                            &lt;/div&gt;
                        @endif
                    &lt;/dl&gt;
                &lt;/div&gt;

                &lt;div&gt;
                    &lt;h3 class="text-lg font-medium text-gray-900 mb-4"&gt;Payment Information&lt;/h3&gt;
                    &lt;dl class="space-y-3"&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Cost&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;₱{{ number_format($treatmentRecord-&gt;cost, 2) }}&lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Payment Status&lt;/dt&gt;
                            &lt;dd class="mt-1"&gt;
                                &lt;span class="px-2 py-1 text-xs rounded-full {{ 
                                    $treatmentRecord-&gt;payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                                    ($treatmentRecord-&gt;payment_status === 'partially_paid' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') 
                                }}"&gt;
                                    {{ ucfirst($treatmentRecord-&gt;payment_status) }}
                                &lt;/span&gt;
                            &lt;/dd&gt;
                        &lt;/div&gt;
                    &lt;/dl&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/x-card&gt;

        &lt;!-- People Involved --&gt;
        &lt;x-card&gt;
            &lt;div class="grid grid-cols-1 md:grid-cols-2 gap-6"&gt;
                &lt;div&gt;
                    &lt;h3 class="text-lg font-medium text-gray-900 mb-4"&gt;Patient Information&lt;/h3&gt;
                    &lt;dl class="space-y-3"&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Name&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $treatmentRecord-&gt;patient-&gt;patient_name }}&lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Contact Information&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $treatmentRecord-&gt;patient-&gt;contact_information }}&lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div class="mt-4"&gt;
                            &lt;a href="{{ route('patients.show', $treatmentRecord-&gt;patient) }}" class="text-blue-500 hover:text-blue-700"&gt;
                                View Patient History
                            &lt;/a&gt;
                        &lt;/div&gt;
                    &lt;/dl&gt;
                &lt;/div&gt;

                &lt;div&gt;
                    &lt;h3 class="text-lg font-medium text-gray-900 mb-4"&gt;Dentist Information&lt;/h3&gt;
                    &lt;dl class="space-y-3"&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Name&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $treatmentRecord-&gt;dentist-&gt;dentist_name }}&lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;dt class="text-sm font-medium text-gray-500"&gt;Specialization&lt;/dt&gt;
                            &lt;dd class="mt-1 text-sm text-gray-900"&gt;{{ $treatmentRecord-&gt;dentist-&gt;specialization }}&lt;/dd&gt;
                        &lt;/div&gt;
                        &lt;div class="mt-4"&gt;
                            &lt;a href="{{ route('dentists.show', $treatmentRecord-&gt;dentist) }}" class="text-blue-500 hover:text-blue-700"&gt;
                                View Dentist Profile
                            &lt;/a&gt;
                        &lt;/div&gt;
                    &lt;/dl&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/x-card&gt;

        &lt;!-- Actions --&gt;
        &lt;x-card&gt;
            &lt;div class="flex justify-between items-center"&gt;
                &lt;div class="text-sm text-gray-500"&gt;
                    Created: {{ $treatmentRecord-&gt;created_at-&gt;format('F d, Y h:i A') }}
                    @if($treatmentRecord-&gt;updated_at-&gt;ne($treatmentRecord-&gt;created_at))
                        &lt;br&gt;Last Updated: {{ $treatmentRecord-&gt;updated_at-&gt;format('F d, Y h:i A') }}
                    @endif
                &lt;/div&gt;
                &lt;form method="POST" action="{{ route('treatment-records.destroy', $treatmentRecord) }}" class="inline"&gt;
                    @csrf
                    @method('DELETE')
                    &lt;button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this treatment record?')"&gt;
                        Delete Record
                    &lt;/button&gt;
                &lt;/form&gt;
            &lt;/div&gt;
        &lt;/x-card&gt;
    &lt;/div&gt;
&lt;/x-layout.app&gt; 