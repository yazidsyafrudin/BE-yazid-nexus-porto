<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'image' => 'nullable|string',
            'featured' => 'nullable|boolean',
            'type' => 'required|string',
            'category' => 'required|string',
            'description_id' => 'required|string',
            'description_en' => 'nullable|string',
            'stack' => 'nullable|array',
            'reactions' => 'nullable|array',
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['description_en'] = $validated['description_en'] ?: $validated['description_id'];
        $validated['featured'] = $validated['featured'] ?? false;

        $project = Project::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Proyek berhasil ditambahkan',
            'data' => $project,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug,' . $id,
            'image' => 'nullable|string',
            'featured' => 'nullable|boolean',
            'type' => 'sometimes|required|string',
            'category' => 'sometimes|required|string',
            'description_id' => 'sometimes|required|string',
            'description_en' => 'nullable|string',
            'stack' => 'nullable|array',
            'reactions' => 'nullable|array',
        ]);

        $project->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Proyek berhasil diperbarui',
            'data' => $project,
        ]);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Proyek berhasil dihapus',
        ]);
    }
}
