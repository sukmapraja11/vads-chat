<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <button type="button" onclick="togglePassword()" class="absolute right-2 top-2 text-sm">

                    Show

                </button>

            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <script>
            function togglePassword() {

                const password =
                    document.getElementById('password');

                if (password.type === 'password') {

                    password.type = 'text';

                } else {

                    password.type = 'password';
                }
            }
        </script>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="mt-4 text-center">
            <a href="/register"
                class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 underline">
                Don't have an account? Register
            </a>
        </div>
    </form>
</x-guest-layout>

<!-- FLOATING CHAT ICON -->
<a href="/register-chat"
    class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg z-50 transition">

    <!-- Chat Icon (Heroicons) -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="w-7 h-7">

        <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.25 12c0 4.97 4.78 9 10.75 9 1.7 0 3.3-.31 4.74-.87L21.75 21l-1.5-3.75C21.07 15.9 21.75 14 21.75 12c0-4.97-4.78-9-10.75-9S2.25 7.03 2.25 12z" />

    </svg>

</a>
