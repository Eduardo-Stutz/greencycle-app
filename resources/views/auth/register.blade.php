<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
        <img src="{{ asset('img/GreenCycle_cadastro.png') }}" alt="Logo" class="w-[300px] h-auto">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Nome completo') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('Telefone') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ old('phone') }}"
                    required />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Senha') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar senha') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Já tem uma conta?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Cadastrar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>