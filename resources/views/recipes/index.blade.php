<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-2 mb-10 bg-gray-200/50 p-1.5 rounded-2xl w-fit">
                <a href="{{ route('recipes.index') }}"
                    class="tab {{ !request('my') ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-emerald-600' }}">
                    Início
                </a>

                @auth
                <a href="{{ route('recipes.index', ['my' => 1]) }}"
                    class="tab {{ request('my') ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-emerald-600' }}">
                    Minhas Receitas
                </a>
                @endauth
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($recipes as $recipe)
                @include('recipes._card', ['recipe' => $recipe])
                @endforeach
            </div>

            <div class="mt-16">
                {{ $recipes->links() }}
            </div>

        </div>
    </div>
</x-app-layout>