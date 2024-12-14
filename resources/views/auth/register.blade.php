<x-guest-layout>
    <div class="flex justify-center mb-8">
        <div class="flex items-center">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
            </svg>
            <span class="ml-2 text-2xl font-semibold text-gray-900">DentalCare RMS</span>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                {{ __('Full Name') }}
            </label>
            <div class="mt-1">
                <input id="name" name="name" type="text" autocomplete="name" required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('name') }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                {{ __('Email address') }}
            </label>
            <div class="mt-1">
                <input id="email" name="email" type="email" autocomplete="email" required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('email') }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Role Selection -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">
                {{ __('Register as') }}
            </label>
            <div class="mt-1">
                <select id="role" name="role" required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Select a role</option>
                    <option value="dentist" {{ old('role') == 'dentist' ? 'selected' : '' }}>Dentist</option>
                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                {{ __('Password') }}
            </label>
            <div class="mt-1">
                <input id="password" name="password" type="password" autocomplete="new-password" required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                {{ __('Confirm Password') }}
            </label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div>
            <button type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('Register') }}
            </button>
        </div>

        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">
                {{ __('Already have an account?') }}
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    {{ __('Sign in here') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout> 