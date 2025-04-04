<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if (session('success'))
        <p class="text-green-500">{{ session('success') }}</p>
    @endif
    <form method="POST" action="{{ route('verify.post') }}">
        @csrf

        <p class="text-white">Te Hemos mandado el código a tu correo revisa</p>
        <p class="text-white">Volver a mandar el código <a href="{{ route('verify.resend') }}"> click aquí</a></p>
        <br>
        <!-- Email Address -->
        <div>
            <x-input-label for="code" :value="__('Code')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        @if (session('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('verify') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
