<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Nova <span class="text-emerald-600">Receita</span></h1>
                    <p class="text-gray-500 mt-1">Compartilhe seus segredos culinários com a comunidade.</p>
                </div>
                <a href="{{ route('recipes.index') }}" class="text-sm font-bold text-gray-400 hover:text-emerald-600 transition">
                    &larr; Cancelar
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100">
                <div class="p-8 text-gray-900">

                    <form method="POST" action="{{ route('recipes.store') }}" class="space-y-8" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Título da Receita')" class="font-bold text-gray-700 ml-1" />
                            <x-text-input id="title" name="title" type="text"
                                class="mt-2 block w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500"
                                placeholder="Ex: Lasanha de Berinjela da Vovó"
                                :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div x-data="{ imagePreview: null }">
                            <x-input-label for="image" :value="__('Foto da Receita')" class="font-bold text-gray-700 ml-1" />

                            <div class="mt-2 flex flex-col items-center justify-center w-full">
                                <label for="image" class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-200 border-dashed rounded-[2.5rem] cursor-pointer bg-gray-50 hover:bg-emerald-50 hover:border-emerald-300 transition-all overflow-hidden relative">

                                    <template x-if="!imagePreview">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-bold">Clique para enviar</span> ou arraste a foto</p>
                                            <p class="text-xs text-gray-400">PNG ou JPG (Máx. 2MB)</p>
                                        </div>
                                    </template>

                                    <template x-if="imagePreview">
                                        <div class="w-full h-full">
                                            <img :src="imagePreview" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                                <p class="text-white text-xs font-bold uppercase tracking-wider">Trocar Imagem</p>
                                            </div>
                                        </div>
                                    </template>

                                    <input id="image" name="image" type="file" class="hidden" accept="image/*"
                                        @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imagePreview = e.target.result }; reader.readAsDataURL(file); } " />
                                </label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Descrição Curta')" class="font-bold text-gray-700 ml-1" />
                            <textarea id="description" name="description"
                                class="mt-2 block w-full border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-2xl shadow-sm"
                                placeholder="Uma breve história ou por que essa receita é especial..."
                                rows="3" required>{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div x-data="{ ingredients: {{ json_encode(old('ingredients', [''])) }} }" class="bg-gray-50 p-6 rounded-3xl border border-gray-100">
                            <x-input-label :value="__('Ingredientes')" class="font-bold text-emerald-800 text-lg mb-4" />

                            <template x-for="(ingredient, index) in ingredients" :key="index">
                                <div class="flex mt-3 gap-3">
                                    <div class="relative flex-1">
                                        <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 text-xs font-bold" x-text="index + 1 + '.'"></span>
                                        <x-text-input name="ingredients[]" x-model="ingredients[index]" type="text"
                                            class="block w-full pl-10 rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500"
                                            placeholder="Ex: 2 colheres de sopa de mel" required />
                                    </div>
                                    <button type="button" @click="ingredients.splice(index, 1)" x-show="ingredients.length > 1"
                                        class="p-2 text-red-400 hover:bg-red-50 rounded-xl transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            <button type="button" @click="ingredients.push('')"
                                class="mt-5 inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-700 rounded-xl font-bold text-xs hover:bg-emerald-200 transition">
                                + Adicionar Ingrediente
                            </button>
                            <x-input-error class="mt-2" :messages="$errors->get('ingredients')" />
                        </div>

                        <div>
                            <x-input-label for="steps" :value="__('Modo de Preparo')" class="font-bold text-gray-700 ml-1" />
                            <textarea id="steps" name="steps"
                                class="mt-2 block w-full border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-2xl shadow-sm"
                                placeholder="1. Comece refogando o alho...&#10;2. Em seguida, adicione..."
                                rows="6" required>{{ old('steps') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('steps')" />
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-emerald-200 transition-all transform hover:-translate-y-1 active:scale-95">
                                PUBLICAR RECEITA AGORA
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>