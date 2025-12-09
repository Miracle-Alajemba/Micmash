{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reset Password - Mic mash</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-white antialiased">

        <div class="flex min-h-screen">

            <!-- LEFT SIDE: Image -->
            <div class="relative hidden w-0 flex-1 lg:block">
                <img class="absolute inset-0 h-full w-full object-cover"
                    src="https://images.unsplash.com/photo-1485217988980-11786ced9454?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                    alt="Forgot Password Background">
                <div class="absolute inset-0 bg-indigo-900 opacity-40"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="px-6 text-center">
                        <h2 class="mb-2 text-4xl font-bold text-white">Don't worry</h2>
                        <p class="text-lg text-indigo-100">It happens to the best of us. We'll get you back on track.
                        </p>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: Form -->
            <div class="flex flex-1 flex-col justify-center bg-white px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
                <div class="mx-auto w-full max-w-sm lg:w-96">

                    <!-- Logo & Heading -->
                    <div>
                        <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600">Micmash</a>
                        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Reset Password</h2>
                    </div>

                    <div class="mt-4">
                        <p class="mb-6 text-sm text-gray-600">
                            Forgot your password? No problem. Just let us know your email address and we will email you
                            a password reset link.
                        </p>

                        <!-- Session Status (Success Message) -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email
                                    address</label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        autofocus value="{{ old('email') }}"
                                        class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit"
                                    class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Email Password Reset Link
                                </button>
                            </div>
                        </form>

                        <!-- Back to Login Link -->
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">
                                Remembered your password?
                                <a href="{{ route('login') }}"
                                    class="font-medium text-indigo-600 hover:text-indigo-500">
                                    Back to login
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </body>

</html>
