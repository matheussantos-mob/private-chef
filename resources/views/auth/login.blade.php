<x-guest-layout>
    <div class="w-full sm:max-w-md bg-white p-10 rounded-[3rem] shadow-xl border border-gray-100 my-10">

        <div class="flex flex-col items-center mb-10">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo RecipeDev" class="h-20 w-auto rounded-2xl mb-4 shadow-sm">
            </a>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Bem Vindo</h1>
            <p class="text-gray-500 text-sm mt-1 text-center">Acesse sua conta para continuar</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="email" :value="__('E-mail')" class="font-bold text-gray-700 ml-1" />
                <x-text-input id="email" class="block mt-2 w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50/50"
                    type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Senha')" class="font-bold text-gray-700 ml-1" />
                <x-text-input id="password" class="block mt-2 w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50/50"
                    type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between px-1">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-200 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                    <span class="ms-2 text-xs text-gray-500 font-bold uppercase tracking-wider">{{ __('Lembrar') }}</span>
                </label>

                @if (Route::has('password.request'))
                <a class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition underline underline-offset-4" href="{{ route('password.request') }}">
                    {{ __('Esqueceu a senha?') }}
                </a>
                @endif
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-emerald-100 transition-all transform hover:-translate-y-1 active:scale-95">
                    ENTRAR NO SISTEMA
                </button>
            </div>

            <div class="text-center mt-8 pt-6 border-t border-gray-50">
                <p class="text-sm text-gray-500">
                    Ainda não tem uma conta?
                    <a href="{{ route('register') }}" class="font-black text-emerald-600 hover:text-emerald-700 transition">
                        Cadastre-se aqui
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>