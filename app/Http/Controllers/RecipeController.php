<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecipeRequest;
use Illuminate\Support\Facades\Gate;



class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query()
            ->with('user')
            ->withAvg('ratings as ratings_avg', 'score')
            ->withCount('ratings');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('my') && auth()->check()) {
            $query->where('user_id', auth()->id());
        }

        $recipes = $query->latest()->paginate(12);

        return view('recipes.index', compact('recipes'));
    }

    public function show(Recipe $recipe)
    {
        $recipe->load([
            'user',
            'comments.user',
        ])->loadAvg('ratings as ratings_avg', 'score')
            ->loadCount('ratings');

        return view('recipes.show', compact('recipe'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(StoreRecipeRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe = auth()->user()->recipes()->create($data);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Receita criada!');
    }

    public function storeComment(Request $request, Recipe $recipe)
    {
        $request->validate([
            'body' => 'required|string|min:5',
            'score' => 'required|integer|min:1|max:5',
        ]);

        $recipe->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        $recipe->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['score' => $request->score]
        );

        return redirect()->back()->with('success', 'Obrigado por avaliar esta receita!');
    }

    public function storeRating(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:1|max:5',
        ]);

        $recipe->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['score' => $validated['score']]
        );

        return back()->with('success', 'Avaliação registrada!');
    }

    public function edit(Recipe $recipe)
    {
        Gate::authorize('update', $recipe);
        return view('recipes.edit', compact('recipe'));
    }

    public function update(StoreRecipeRequest $request, Recipe $recipe)
    {
        Gate::authorize('update', $recipe);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($data);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Receita atualizada com sucesso!');
    }

    public function destroy(Recipe $recipe)
    {
        Gate::authorize('delete', $recipe);
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Receita removida!');
    }
}
