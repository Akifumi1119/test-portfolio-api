<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        return Pet::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
        ]);

        $pet = Pet::create($validated);

        return response()->json($pet, 201);
    }

    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
        ]);

        $pet->update($validated);

        return response()->json($pet);
    }

    public function show(Pet $pet)
    {
        return response()->json($pet);
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return response()->json([
            'message' => '削除しました',
        ]);
    }
}