<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('onboarding.title') }} - {{ config('app.name') }}</title>
    @filamentStyles
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 dark:bg-gray-950">
    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Language Switcher -->
        <div class="fixed top-4 right-4 z-50">
            <div class="flex gap-2 bg-white dark:bg-gray-900 rounded-lg shadow-lg ring-1 ring-gray-950/5 dark:ring-white/10 p-1">
                <a href="{{ route('language.switch', 'en') }}"
                   class="px-3 py-1.5 text-sm font-medium rounded-md transition-colors {{ app()->getLocale() === 'en' ? 'bg-primary-600 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    EN
                </a>
                <a href="{{ route('language.switch', 'fr') }}"
                   class="px-3 py-1.5 text-sm font-medium rounded-md transition-colors {{ app()->getLocale() === 'fr' ? 'bg-primary-600 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    FR
                </a>
            </div>
        </div>

        <div class="w-full max-w-md">
            <!-- Main Card -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg ring-1 ring-gray-950/5 dark:ring-white/10">
                <!-- Header -->
                <div class="p-8 text-center border-b border-gray-200 dark:border-gray-800">
                    <div class="flex justify-center mb-4">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-primary-50 dark:bg-primary-500/10">
                            <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-950 dark:text-white">{{ __('onboarding.welcome') }}</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('onboarding.subtitle') }}</p>
                </div>

                <!-- Form -->
                <div class="p-8">
                    @if($errors->any())
                        <div class="mb-6 rounded-lg bg-danger-50 dark:bg-danger-500/10 p-4 ring-1 ring-danger-600/10 dark:ring-danger-500/20">
                            <div class="flex gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-danger-600 dark:text-danger-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-danger-800 dark:text-danger-400">{{ __('onboarding.errors.validation_title') }}</h3>
                                    <ul class="mt-2 text-sm text-danger-700 dark:text-danger-400 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li class="flex items-start gap-2">
                                                <span class="text-danger-600 dark:text-danger-400">•</span>
                                                <span>{{ $error }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('onboarding.store') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="text-sm font-medium text-gray-950 dark:text-white">
                                {{ __('onboarding.form.name') }}
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                class="mt-2 block w-full rounded-lg border-0 bg-white dark:bg-white/5 px-3 py-2 text-gray-950 dark:text-white shadow-sm ring-1 ring-inset ring-gray-950/10 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500 @error('name') ring-danger-600 dark:ring-danger-500 @enderror"
                                placeholder="{{ __('onboarding.form.name_placeholder') }}"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="text-sm font-medium text-gray-950 dark:text-white">
                                {{ __('onboarding.form.email') }}
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                class="mt-2 block w-full rounded-lg border-0 bg-white dark:bg-white/5 px-3 py-2 text-gray-950 dark:text-white shadow-sm ring-1 ring-inset ring-gray-950/10 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500 @error('email') ring-danger-600 dark:ring-danger-500 @enderror"
                                placeholder="{{ __('onboarding.form.email_placeholder') }}"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="text-sm font-medium text-gray-950 dark:text-white">
                                {{ __('onboarding.form.password') }}
                            </label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                class="mt-2 block w-full rounded-lg border-0 bg-white dark:bg-white/5 px-3 py-2 text-gray-950 dark:text-white shadow-sm ring-1 ring-inset ring-gray-950/10 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500 @error('password') ring-danger-600 dark:ring-danger-500 @enderror"
                                placeholder="{{ __('onboarding.form.password_placeholder') }}"
                            >
                            <p class="mt-2 text-xs text-gray-600 dark:text-gray-400">{{ __('onboarding.form.password_hint') }}</p>
                            @error('password')
                                <p class="mt-2 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="text-sm font-medium text-gray-950 dark:text-white">
                                {{ __('onboarding.form.password_confirmation') }}
                            </label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                required
                                class="mt-2 block w-full rounded-lg border-0 bg-white dark:bg-white/5 px-3 py-2 text-gray-950 dark:text-white shadow-sm ring-1 ring-inset ring-gray-950/10 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500"
                                placeholder="{{ __('onboarding.form.password_placeholder') }}"
                            >
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:bg-primary-500 dark:hover:bg-primary-400 dark:ring-offset-gray-900 transition-colors"
                        >
                            {{ __('onboarding.form.submit') }}
                        </button>
                    </form>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 dark:bg-white/5 px-8 py-4 border-t border-gray-200 dark:border-gray-800 rounded-b-xl">
                    <p class="text-xs text-center text-gray-600 dark:text-gray-400">
                        {{ __('onboarding.info.footer') }}
                    </p>
                </div>
            </div>

            <!-- Info Card -->
            <div class="mt-6 rounded-lg bg-primary-50 dark:bg-primary-500/10 p-4 ring-1 ring-primary-600/10 dark:ring-primary-500/20">
                <div class="flex gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-primary-800 dark:text-primary-400">{{ __('onboarding.info.title') }}</h3>
                        <p class="mt-1 text-sm text-primary-700 dark:text-primary-400">
                            {{ __('onboarding.info.description') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @filamentScripts
    @vite('resources/js/app.js')
</body>
</html>
