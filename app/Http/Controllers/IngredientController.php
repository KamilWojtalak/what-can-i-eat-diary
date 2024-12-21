<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Day;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Search for ingredient suggestions.
     */
    public function searchSuggestions(Request $request)
    {
        $query = $request->input('q');
        $selected = $request->input('selected');
        $selectedIds = explode(',', $selected);
        $words = explode(' ', $query);

        $suggestions = Ingredient::whereNotIn('id', $selectedIds)
            ->where(function ($query) use ($words) {
            foreach ($words as $word) {
                $query->where('name', 'LIKE', "%{$word}%");
            }
            })->get();

        return response()->json($suggestions);
    }

    public function saveIngredients(Request $request, Day $day)
    {
        $ingredientIds = $request->input('ingredients');
        $day->ingredients()->sync($ingredientIds);

        return response()->json(['message' => 'Ingredients saved successfully.']);
    }

    public function storeNewIngredient(Request $request)
    {
        $query = $request->input('query');

        $ingredient = Ingredient::create(['name' => $query]);

        return response()->json([
            'message' => 'Ingredients saved successfully.',
            'ingredient' => $ingredient,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIngredientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIngredientRequest $request, Ingredient $ingredient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        //
    }
}
