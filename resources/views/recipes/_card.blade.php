<a href="{{ route('recipes.show', $recipe) }}" class="group block bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
    <div class="aspect-square w-full relative overflow-hidden bg-gray-100">
        @if($recipe->image)
            <img src="{{ asset('storage/' . $recipe->image) }}" 
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
        @else
            <div class="w-full h-full flex items-center justify-center bg-emerald-50 text-emerald-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="1.5"/></svg>
            </div>
        @endif
        
        <div class="absolute top-3 left-3">
            <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest text-gray-800 shadow-sm">
                {{ $recipe->user->name }}
            </span>
        </div>
    </div>

    <div class="p-5">
        <h3 class="font-bold text-gray-900 text-lg leading-tight mb-2 truncate group-hover:text-emerald-600 transition-colors">
            {{ $recipe->title }}
        </h3>
        
        {{-- Estrelas --}}
        <div class="flex items-center gap-1 mb-2">
            @php $avg = round($recipe->ratings_avg ?? 0); @endphp
            @for($i = 1; $i <= 5; $i++)
                <svg class="h-4 w-4 {{ $i <= $avg ? 'text-yellow-400 fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                </svg>
            @endfor
            <span class="text-xs font-bold text-gray-400 ml-1">{{ number_format($recipe->ratings_avg ?? 0, 1) }}</span>
        </div>

        {{-- Texto de call-to-action sutil em vez de botão --}}
        <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider opacity-0 group-hover:opacity-100 transition-opacity">
            Ver receita completa &rarr;
        </p>
    </div>
</a>