<nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('recipes.index') }}" class="flex items-center group">
                    <img src="{{ asset('images/logo.png') }}"
                        alt="Logo RecipeDev"
                        class="h-12 w-auto rounded-xl transition-transform duration-300 group-hover:scale-105 shadow-sm">
                </a>
            </div>

            <div class="hidden md:flex flex-1 justify-center px-10">
                <form action="{{ route('recipes.index') }}" method="GET" class="w-full max-w-md relative">
                    <input type="text" name="search" placeholder="Buscar por ingredientes ou pratos..."
                        class="w-full border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm pl-4 pr-10 py-2.5 text-sm">
                    <div class="absolute right-3 top-2.5 text-gray-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" />
                        </svg>
                    </div>
                </form>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                <a href="{{ route('recipes.create') }}"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-all shadow-md">
                    + Receita
                </a>

                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-gray-500 bg-white hover:text-emerald-600 focus:outline-none transition ease-in-out duration-150 border-gray-100 shadow-sm">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Meu Perfil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                    class="text-red-600">
                                    {{ __('Sair do Sistema') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-gray-600 font-semibold hover:text-indigo-600 transition text-sm">Entrar</a>
                <a href="{{ route('register') }}"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-all shadow-md">
                    Cadastrar
                </a>
                @endauth
            </div>
        </div>
    </div>
</nav>