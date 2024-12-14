<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dental Clinic - Record Management System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
            <!-- Navigation -->
            <nav class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                                <span class="ml-2 text-xl font-semibold text-gray-900">DentalCare RMS</span>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="flex items-center">
                            @if (Route::has('login'))
                                <div class="space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Dashboard
                                        </a>
                                    @else
                                        <button type="button" onclick="toggleModal('loginModal')" class="text-gray-600 hover:text-gray-900">
                                            Log in
                                        </button>

                                        <button type="button" onclick="toggleModal('registerModal')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Register
                                        </button>
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                    <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                        <h1>
                            <span class="block text-sm font-semibold uppercase tracking-wide text-blue-600">
                                Welcome to
                            </span>
                            <span class="mt-1 block text-4xl tracking-tight font-extrabold sm:text-5xl xl:text-6xl">
                                <span class="block text-gray-900">DentalCare</span>
                                <span class="block text-blue-600">Record Management</span>
                            </span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                            A comprehensive system for managing dental clinic records, appointments, and patient information. Streamline your dental practice with our efficient record management solution.
                        </p>
                    </div>
                    <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                        <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                            <div class="relative block w-full bg-white rounded-lg overflow-hidden">
                                <img class="w-full" src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=800&amp;h=600&amp;q=80" alt="Dental Clinic">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="mt-16">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="pt-6">
                            <div class="flow-root bg-white rounded-lg px-6 pb-8">
                                <div class="-mt-6">
                                    <div>
                                        <span class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-md shadow-lg">
                                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Patient Records</h3>
                                    <p class="mt-5 text-base text-gray-500">
                                        Securely manage and access patient information, medical history, and treatment plans.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="pt-6">
                            <div class="flow-root bg-white rounded-lg px-6 pb-8">
                                <div class="-mt-6">
                                    <div>
                                        <span class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-md shadow-lg">
                                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Appointment Management</h3>
                                    <p class="mt-5 text-base text-gray-500">
                                        Efficiently schedule and manage appointments with an intuitive calendar interface.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="pt-6">
                            <div class="flow-root bg-white rounded-lg px-6 pb-8">
                                <div class="-mt-6">
                                    <div>
                                        <span class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-md shadow-lg">
                                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Treatment Tracking</h3>
                                    <p class="mt-5 text-base text-gray-500">
                                        Track and monitor patient treatments, procedures, and progress over time.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
                    <div class="mt-8 md:mt-0 md:order-1">
                        <p class="text-center text-base text-gray-400">
                            &copy; {{ date('Y') }} DentalCare RMS. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>

            <!-- Login Modal -->
            <div id="loginModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <!-- Modal panel -->
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                        <div class="absolute top-0 right-0 pt-4 pr-4">
                            <button type="button" onclick="toggleModal('loginModal')" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="flex justify-center mb-4">
                                <div class="flex items-center">
                                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                    <span class="ml-2 text-2xl font-semibold text-gray-900">Sign In</span>
                                </div>
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                                @csrf
                                <!-- Email Address -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <div class="mt-1">
                                        <input id="email" name="email" type="email" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                                            value="{{ old('email') }}" />
                                        @error('email')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <div class="mt-1">
                                        <input id="password" name="password" type="password" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-500 @enderror" />
                                        @error('password')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Remember Me and Forgot Password -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input id="remember_me" name="remember" type="checkbox" 
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <div class="text-sm">
                                            <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                                Forgot password?
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Sign in
                                    </button>
                                </div>

                                <div class="text-center text-sm text-gray-600">
                                    Don't have an account? 
                                    <button type="button" onclick="switchModal('loginModal', 'registerModal')" class="font-medium text-blue-600 hover:text-blue-500">
                                        Register here
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Register Modal -->
            <div id="registerModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <!-- Modal panel -->
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                        <div class="absolute top-0 right-0 pt-4 pr-4">
                            <button type="button" onclick="toggleModal('registerModal')" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="flex justify-center mb-4">
                                <div class="flex items-center">
                                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                    <span class="ml-2 text-2xl font-semibold text-gray-900">Register</span>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                                @csrf
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <div class="mt-1">
                                        <input id="name" name="name" type="text" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-500 @enderror"
                                            value="{{ old('name') }}" />
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email Address -->
                                <div>
                                    <label for="register_email" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <div class="mt-1">
                                        <input id="register_email" name="email" type="email" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                                            value="{{ old('email') }}" />
                                        @error('email')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Role Selection -->
                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700">Register as</label>
                                    <div class="mt-1">
                                        <select id="role" name="role" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('role') border-red-500 @enderror">
                                            <option value="">Select a role</option>
                                            <option value="dentist" {{ old('role') == 'dentist' ? 'selected' : '' }}>Dentist</option>
                                            <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                        </select>
                                        @error('role')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="register_password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <div class="mt-1">
                                        <input id="register_password" name="password" type="password" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-500 @enderror" />
                                        @error('password')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                    <div class="mt-1">
                                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Register
                                    </button>
                                </div>

                                <div class="text-center text-sm text-gray-600">
                                    Already have an account? 
                                    <button type="button" onclick="switchModal('registerModal', 'loginModal')" class="font-medium text-blue-600 hover:text-blue-500">
                                        Sign in here
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update the Modal Toggle Script -->
            <script>
                function toggleModal(modalId) {
                    const modal = document.getElementById(modalId);
                    if (modal.classList.contains('hidden')) {
                        modal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    } else {
                        modal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }
                }

                function switchModal(closeModalId, openModalId) {
                    // Close the current modal
                    const closeModal = document.getElementById(closeModalId);
                    closeModal.classList.add('hidden');

                    // Open the other modal
                    const openModal = document.getElementById(openModalId);
                    openModal.classList.remove('hidden');
                }

                // Close modal when clicking outside
                window.onclick = function(event) {
                    const loginModal = document.getElementById('loginModal');
                    const registerModal = document.getElementById('registerModal');
                    if (event.target === loginModal || event.target === registerModal) {
                        loginModal.classList.add('hidden');
                        registerModal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }
                }

                // Show modal if there are validation errors
                @if($errors->any())
                    @if($errors->has('email') || $errors->has('password'))
                        document.addEventListener('DOMContentLoaded', function() {
                            toggleModal('loginModal');
                        });
                    @else
                        document.addEventListener('DOMContentLoaded', function() {
                            toggleModal('registerModal');
                        });
                    @endif
                @endif
            </script>
        </div>
    </body>
</html>
