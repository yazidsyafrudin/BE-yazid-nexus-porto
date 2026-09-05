<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return response()->json(['status' => 'success', 'data' => $projects]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return response()->json(['status' => 'success', 'data' => $project]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|unique:projects,slug',
            'title' => 'required|string',
            'image' => 'nullable|string',
            'featured' => 'boolean',
            'type' => 'required|string',
            'category' => 'required|string',
            'description_id' => 'required|string',
            'description_en' => 'required|string',
            'stack' => 'required|array',
            'reactions' => 'nullable|array',
        ]);

        $project = Project::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Proyek berhasil ditambahkan!',
            'data' => $project
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'slug' => 'sometimes|string|unique:projects,slug,' . $id,
            'title' => 'sometimes|string',
            'image' => 'nullable|string',
            'featured' => 'boolean',
            'type' => 'sometimes|string',
            'category' => 'sometimes|string',
            'description_id' => 'sometimes|string',
            'description_en' => 'sometimes|string',
            'stack' => 'sometimes|array',
            'reactions' => 'nullable|array',
        ]);

        $project->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Proyek berhasil diperbarui!',
            'data' => $project
        ]);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Proyek berhasil dihapus!'
        ]);
    }
}
