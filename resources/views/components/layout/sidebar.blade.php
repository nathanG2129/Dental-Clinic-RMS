@php
    $user = Auth::user();
    $role = $user->role;
@endphp

<aside class="w-64 bg-white shadow-md">
    <div class="h-full px-3 py-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            @if($role === 'admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('patients.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Patients</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dentists.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Dentists</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('appointments.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('treatment-records.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Treatment Records</span>
                    </a>
                </li>
            @elseif($role === 'dentist')
                <li>
                    <a href="{{ route('dentist.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('patients.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Patients</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('appointments.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('treatment-records.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Treatment Records</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('employee.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('patients.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Patients</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('appointments.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                        <span class="ml-3">Appointments</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside> 