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

    public function show($id)
    {
        $achievement = Achievement::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $achievement]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'date' => 'required|string|max:100',
            'image' => 'nullable|string',
            'credential_url' => 'nullable|string',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $validated['description_en'] = $validated['description_en'] ?? $validated['description_id'];

        $achievement = Achievement::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pencapaian berhasil ditambahkan',
            'data' => $achievement,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'issuer' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|string|max:100',
            'image' => 'nullable|string',
            'credential_url' => 'nullable|string',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $achievement->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pencapaian berhasil diperbarui',
            'data' => $achievement,
        ]);
    }

    public function destroy($id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pencapaian berhasil dihapus',
        ]);
    }
}
