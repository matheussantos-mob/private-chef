<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

/*
| Rotas Públicas
*/

// A página inicial agora é a listagem de receitas
Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');

// Detalhes da receita
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');


/*
| Rotas Autenticadas
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Perfil do Usuário 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gerenciamento de Receitas
    Route::get('/recipe/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update'); // Importante para salvar a edição!
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

    // Interações
    Route::post('/recipes/{recipe}/comments', [RecipeController::class, 'storeComment'])->name('comments.store');
    Route::post('/recipes/{recipe}/ratings', [RecipeController::class, 'storeRating'])->name('ratings.store');
});

require __DIR__.'/auth.php';