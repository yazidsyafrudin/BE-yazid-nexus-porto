<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $experiences,
        ]);
    }

    public function show($id)
    {
        $experience = Experience::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $experience,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'role_id' => 'required|string|max:255',
            'role_en' => 'nullable|string|max:255',
            'location_id' => 'required|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'period_id' => 'required|string|max:255',
            'period_en' => 'nullable|string|max:255',
            'duration_id' => 'required|string|max:255',
            'duration_en' => 'nullable|string|max:255',
            'employment_id' => 'required|string|max:255',
            'employment_en' => 'nullable|string|max:255',
            'arrangement_id' => 'required|string|max:255',
            'arrangement_en' => 'nullable|string|max:255',
            'tasks' => 'nullable|array',
            'learnings' => 'nullable|array',
            'impact' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        // Fallbacks for en fields if not provided
        $validated['role_en'] = $validated['role_en'] ?? $validated['role_id'];
        $validated['location_en'] = $validated['location_en'] ?? $validated['location_id'];
        $validated['period_en'] = $validated['period_en'] ?? $validated['period_id'];
        $validated['duration_en'] = $validated['duration_en'] ?? $validated['duration_id'];
        $validated['employment_en'] = $validated['employment_en'] ?? $validated['employment_id'];
        $validated['arrangement_en'] = $validated['arrangement_en'] ?? $validated['arrangement_id'];
        $validated['logo'] = $validated['logo'] ?? strtoupper(substr($validated['company'], 0, 2));

        $experience = Experience::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Karier berhasil ditambahkan',
            'data' => $experience,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);

        $validated = $request->validate([
            'company' => 'sometimes|required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'role_id' => 'sometimes|required|string|max:255',
            'role_en' => 'nullable|string|max:255',
            'location_id' => 'sometimes|required|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'period_id' => 'sometimes|required|string|max:255',
            'period_en' => 'nullable|string|max:255',
            'duration_id' => 'sometimes|required|string|max:255',
            'duration_en' => 'nullable|string|max:255',
            'employment_id' => 'sometimes|required|string|max:255',
            'employment_en' => 'nullable|string|max:255',
            'arrangement_id' => 'sometimes|required|string|max:255',
            'arrangement_en' => 'nullable|string|max:255',
            'tasks' => 'nullable|array',
            'learnings' => 'nullable|array',
            'impact' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        if (isset($validated['role_id']) && empty($validated['role_en'])) {
            $validated['role_en'] = $validated['role_id'];
        }
        if (isset($validated['location_id']) && empty($validated['location_en'])) {
            $validated['location_en'] = $validated['location_id'];
        }
        if (isset($validated['period_id']) && empty($validated['period_en'])) {
            $validated['period_en'] = $validated['period_id'];
        }
        if (isset($validated['duration_id']) && empty($validated['duration_en'])) {
            $validated['duration_en'] = $validated['duration_id'];
        }
        if (isset($validated['employment_id']) && empty($validated['employment_en'])) {
            $validated['employment_en'] = $validated['employment_id'];
        }
        if (isset($validated['arrangement_id']) && empty($validated['arrangement_en'])) {
            $validated['arrangement_en'] = $validated['arrangement_id'];
        }

        $experience->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Karier berhasil diperbarui',
            'data' => $experience,
        ]);
    }

    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Karier berhasil dihapus',
        ]);
    }
}
