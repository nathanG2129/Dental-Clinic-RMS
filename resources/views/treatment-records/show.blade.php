<x-layout.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Treatment Record Details') }}
            </h2>
            @php
                $role = auth()->user()->role;
            @endphp
            <div class="flex space-x-2">
                <a href="{{ route($role . '.treatment-records.edit', $treatmentRecord) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    Edit Record
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Treatment Information -->
        <x-card>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Treatment Details</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Treatment Type</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $treatmentRecord->treatment_type }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Treatment Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $treatmentRecord->treatment_date->format('F d, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Treatment Details</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $treatmentRecord->treatment_details }}</dd>
                        </div>
                        @if($treatmentRecord->notes)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Additional Notes</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $treatmentRecord->notes }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Cost</dt>
                            <dd class="mt-1 text-sm text-gray-900">₱{{ number_format($treatmentRecord->cost, 2) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Payment Status</dt>
                            <dd class="mt-1">
                                <span class="px-2 py-1 text-xs rounded-full {{ 
                                    $treatmentRecord->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                                    ($treatmentRecord->payment_status === 'partially_paid' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') 
                                }}">
                                    {{ ucfirst($treatmentRecord->payment_status) }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </x-card>

        <!-- People Involved -->
        <x-card>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Patient Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $treatmentRecord->patient->patient_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Contact Information</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $treatmentRecord->patient->contact_information }}</dd>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route($role . '.patients.show', $treatmentRecord->patient) }}" class="text-blue-500 hover:text-blue-700">
                                View Patient History
                            </a>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Dentist Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $treatmentRecord->dentist->dentist_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Specialization</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $treatmentRecord->dentist->specialization }}</dd>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route($role . '.dentists.show', $treatmentRecord->dentist) }}" class="text-blue-500 hover:text-blue-700">
                                View Dentist Profile
                            </a>
                        </div>
                    </dl>
                </div>
            </div>
        </x-card>

        <!-- Actions -->
        <x-card>
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Created: {{ $treatmentRecord->created_at->format('F d, Y h:i A') }}
                    @if($treatmentRecord->updated_at->ne($treatmentRecord->created_at))
                        <br>Last Updated: {{ $treatmentRecord->updated_at->format('F d, Y h:i A') }}
                    @endif
                </div>
                <form method="POST" action="{{ route($role . '.treatment-records.destroy', $treatmentRecord) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this treatment record?')">
                        Delete Record
                    </button>
                </form>
            </div>
        </x-card>
    </div>
</x-layout.app> 