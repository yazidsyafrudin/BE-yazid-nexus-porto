<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->get();
        return response()->json(['status' => 'success', 'data' => $achievements]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'issuer' => 'required|string',
            'date' => 'required|string',
            'image' => 'nullable|string',
            'credential_url' => 'nullable|string',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $achievement = Achievement::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pencapaian berhasil ditambahkan!',
            'data' => $achievement
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string',
            'issuer' => 'sometimes|string',
            'date' => 'sometimes|string',
            'image' => 'nullable|string',
            'credential_url' => 'nullable|string',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $achievement->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pencapaian berhasil diperbarui!',
            'data' => $achievement
        ]);
    }

    public function destroy($id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pencapaian berhasil dihapus!'
        ]);
    }
}
