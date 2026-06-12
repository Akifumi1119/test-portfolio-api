<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->pets;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
        ]);

        $pet = $request->user()->pets()->create($validated);

        return response()->json($pet, 201);
    }

    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
        ]);

        $pet->update($validated);

        return response()->json($pet);
    }

    public function show(Request $request, Pet $pet)
    {
        $this->authorize('view', $pet);

        return response()->json($pet);
    }

    public function destroy(Pet $pet)
    {
        $this->authorize('delete', $pet);

        $pet->delete();

        return response()->json(['message' => '削除しました']);
    }
}
