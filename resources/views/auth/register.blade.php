<x-guest-layout>
    <div class="w-full sm:max-w-md bg-white p-10 rounded-[3rem] shadow-xl border border-gray-100 my-10">
        
        <div class="flex flex-col items-center mb-8">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo RecipeDev" class="h-20 w-auto rounded-2xl mb-4 shadow-sm">
            </a>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Criar <span class="text-emerald-600">Conta</span></h1>
            <p class="text-gray-500 text-sm mt-1 text-center">Junte-se à nossa comunidade de chefs!</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Nome Completo')" class="font-bold text-gray-700 ml-1" />
                <x-text-input id="name" class="block mt-2 w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50/50" 
                             type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('E-mail')" class="font-bold text-gray-700 ml-1" />
                <x-text-input id="email" class="block mt-2 w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50/50" 
                             type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Senha')" class="font-bold text-gray-700 ml-1" />
                <x-text-input id="password" class="block mt-2 w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50/50"
                             type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="font-bold text-gray-700 ml-1" />
                <x-text-input id="password_confirmation" class="block mt-2 w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50/50"
                             type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-emerald-100 transition-all transform hover:-translate-y-1 active:scale-95">
                    CRIAR MINHA CONTA
                </button>
            </div>

            <div class="text-center mt-6 pt-6 border-t border-gray-50">
                <p class="text-sm text-gray-500">
                    Já possui registro? 
                    <a href="{{ route('login') }}" class="font-black text-emerald-600 hover:text-emerald-700 transition">
                        Entrar agora
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>