<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\PetRecord;

class PetRecordController extends Controller
{
    public function store(Request $request, Pet $pet) 
    {
        $validated = $request->validate([
            'record_type' => ['required'],
            'memo' => ['required'],
            'recorded_at' => ['required', 'date'],
        ]);

        $record = $pet->records()->create([
            'record_type' => $validated['record_type'],
            'memo' => $validated['memo'],
            'recorded_at' => $validated['recorded_at'],
        ]);

        return response()->json(
            $record,
            201
        );
    }
    public function index(Pet $pet)
    {
        return response()->json(
            $pet->records()
                ->latest('recorded_at')
                ->get()
        );
    }
    public function destroy(PetRecord $record)
    {
        $record->delete();

        return response()->json([
            'message' => '削除しました',
        ]);
    }
}
