<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 px-4 sm:px-0">
                <a href="{{ route('recipes.index') }}" class="inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Voltar para receitas
                </a>

                @can('update', $recipe)
                <div class="flex items-center gap-3">
                    <a href="{{ route('recipes.edit', $recipe) }}" class="bg-white border border-gray-200 text-gray-700 px-5 py-2 rounded-2xl text-sm font-bold hover:bg-gray-50 transition shadow-sm">Editar</a>

                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir esta receita?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-50 text-red-600 px-5 py-2 rounded-2xl text-sm font-bold hover:bg-red-100 transition">Excluir</button>
                    </form>
                </div>
                @endcan
            </div>

            <div class="bg-white shadow-sm rounded-[3rem] overflow-hidden border border-gray-100">

                <div class="w-full h-[400px] relative">
                    @if($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-emerald-100 flex items-center justify-center text-emerald-300">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="1" />
                        </svg>
                    </div>
                    @endif

                    <div class="absolute -bottom-6 right-10 bg-white px-6 py-4 rounded-3xl shadow-xl border border-gray-50 flex flex-col items-center">
                        <span class="text-3xl font-black text-gray-900 leading-none">⭐ {{ number_format($recipe->ratings_avg, 1) ?? '0.0' }}</span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">{{ $recipe->ratings_count }} avaliações</span>
                    </div>
                </div>

                <div class="p-10 pt-16">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-sm uppercase">
                            {{ substr($recipe->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-black text-gray-900 leading-none">{{ $recipe->user->name }}</p>
                            <p class="text-xs text-gray-400 mt-1">Publicado em {{ $recipe->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>

                    <h1 class="text-4xl font-black text-gray-900 mb-6 leading-tight">{{ $recipe->title }}</h1>

                    <p class="text-lg text-gray-600 leading-relaxed italic border-l-4 border-emerald-500 pl-6 mb-10">
                        "{{ $recipe->description }}"
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                        <div class="md:col-span-1">
                            <h3 class="text-xl font-black text-gray-900 mb-6 flex items-center">
                                <span class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mr-3 text-sm">🛒</span>
                                Ingredientes
                            </h3>
                            <ul class="space-y-4">
                                @foreach($recipe->ingredients as $ingredient)
                                <li class="flex items-start text-gray-700 text-sm">
                                    <span class="text-emerald-500 mr-2">•</span>
                                    {{ $ingredient }}
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-xl font-black text-gray-900 mb-6 flex items-center">
                                <span class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mr-3 text-sm">🔥</span>
                                Passo a Passo
                            </h3>
                            <div class="text-gray-700 leading-loose whitespace-pre-line bg-gray-50 p-8 rounded-[2rem] border border-gray-100">
                                {{ $recipe->steps }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100">
                <h3 class="text-2xl font-black text-gray-900 mb-8">O que a comunidade achou?</h3>

                @auth
                @php
                $hasRated = $recipe->ratings->contains('user_id', auth()->id());
                @endphp

                @if(!$hasRated)
                <form action="{{ route('comments.store', $recipe) }}" method="POST" class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 mb-10">
                    @csrf
                    <h4 class="text-lg font-bold text-gray-900 mb-4">Deixe sua opinião</h4>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="md:col-span-1">
                            <label class="block text-sm font-bold text-emerald-800 mb-2">Sua Nota</label>
                            <select name="score" class="w-full border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-2xl text-sm">
                                <option value="5">⭐⭐⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="1">⭐</option>
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Comentário</label>
                            <textarea name="body" rows="3" class="w-full border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-2xl text-sm" placeholder="O que você achou dessa receita?" required></textarea>
                        </div>
                    </div>

                    <button type="submit" class="mt-6 w-full md:w-auto bg-emerald-600 text-white px-10 py-3 rounded-2xl font-black text-sm hover:bg-emerald-700 transition shadow-lg shadow-emerald-100">
                        PUBLICAR AVALIAÇÃO
                    </button>
                </form>
                @else
                <div class="bg-emerald-50 border border-emerald-100 p-6 rounded-[2rem] mb-10 flex items-center justify-center gap-3">
                    <span class="text-2xl">✅</span>
                    <p class="text-emerald-800 font-bold">Você já avaliou esta receita. Obrigado pela sua participação!</p>
                </div>
                @endif
                @else
                <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 text-center mb-10">
                    <p class="text-gray-600">Deseja avaliar esta receita? <a href="{{ route('login') }}" class="text-emerald-600 font-black hover:underline">Faça login agora</a>.</p>
                </div>
                @endauth

                <div class="border-t border-gray-100 pt-10">
                    <h3 class="text-2xl font-black text-gray-900 mb-8">
                        Comentários <span class="text-emerald-600">({{ $recipe->comments->count() }})</span>
                    </h3>
                    <div class="space-y-6">
                        @forelse($recipe->comments as $comment)
                        <div class="flex gap-4 p-6 rounded-3xl border border-gray-50 bg-white shadow-sm">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex-shrink-0 flex items-center justify-center font-bold text-gray-400">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-gray-900 text-sm">{{ $comment->user->name }}</h4>
                                        @php
                                        $rating = $recipe->ratings->where('user_id', $comment->user_id)->first();
                                        @endphp
                                        @if($rating)
                                        <span class="text-xs bg-yellow-50 text-yellow-600 px-2 py-0.5 rounded-lg font-bold flex items-center">
                                            ⭐ {{ $rating->score }}
                                        </span>
                                        @endif
                                    </div>
                                    <span class="text-[10px] text-gray-400 font-bold uppercase">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $comment->body }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-gray-400 py-10 italic">Ninguém comentou ainda. Seja o primeiro!</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>