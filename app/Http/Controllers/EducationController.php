<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $education = Education::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $education,
        ]);
    }

    public function show($id)
    {
        $education = Education::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $education,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'degree_id' => 'required|string|max:255',
            'degree_en' => 'nullable|string|max:255',
            'major_id' => 'required|string|max:255',
            'major_en' => 'nullable|string|max:255',
            'gpa' => 'nullable|string|max:50',
            'period' => 'required|string|max:100',
            'location_id' => 'required|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $validated['degree_en'] = $validated['degree_en'] ?? $validated['degree_id'];
        $validated['major_en'] = $validated['major_en'] ?? $validated['major_id'];
        $validated['location_en'] = $validated['location_en'] ?? $validated['location_id'];
        $validated['logo'] = $validated['logo'] ?? strtoupper(substr($validated['school'], 0, 2));

        $education = Education::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pendidikan berhasil ditambahkan',
            'data' => $education,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);

        $validated = $request->validate([
            'school' => 'sometimes|required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'degree_id' => 'sometimes|required|string|max:255',
            'degree_en' => 'nullable|string|max:255',
            'major_id' => 'sometimes|required|string|max:255',
            'major_en' => 'nullable|string|max:255',
            'gpa' => 'nullable|string|max:50',
            'period' => 'sometimes|required|string|max:100',
            'location_id' => 'sometimes|required|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if (isset($validated['degree_id']) && empty($validated['degree_en'])) {
            $validated['degree_en'] = $validated['degree_id'];
        }
        if (isset($validated['major_id']) && empty($validated['major_en'])) {
            $validated['major_en'] = $validated['major_id'];
        }
        if (isset($validated['location_id']) && empty($validated['location_en'])) {
            $validated['location_en'] = $validated['location_id'];
        }

        $education->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Pendidikan berhasil diperbarui',
            'data' => $education,
        ]);
    }

    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pendidikan berhasil dihapus',
        ]);
    }
}
