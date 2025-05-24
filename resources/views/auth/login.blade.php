<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="auth-title">Iniciar Sesión</h2>
        <p class="auth-subtitle">Ingrese sus credenciales para acceder al sistema</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="ejemplo@correo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Ingrese su contraseña" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="flex flex-col space-y-4 mt-6">
            <button type="submit" class="auth-button">
                {{ __('Iniciar Sesión') }}
            </button>
            
            <div class="flex items-center justify-between mt-2">
                @if (Route::has('password.request'))
                    <a class="auth-link text-sm" href="{{ route('password.request') }}">
                        {{ __('¿Olvidó su contraseña?') }}
                    </a>
                @endif
                
                @if (Route::has('register'))
                    <a class="auth-link text-sm" href="{{ route('register') }}">
                        {{ __('Crear cuenta nueva') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
</x-guest-layout>
