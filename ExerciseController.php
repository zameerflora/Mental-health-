<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * GET /api/exercises - Get all exercises
     */
    public function index()
    {
        return response()->json(Exercise::all());
    }

    /**
     * GET /api/exercises/{id} - Get single exercise
     */
    public function show($id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json(['message' => 'Exercise not found'], 404);
        }

        return response()->json($exercise);
    }

    /**
     * POST /api/exercises - Create exercise
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'type'        => 'required|string', // e.g., 'breathing', 'journaling'
            'duration'    => 'nullable|integer', // duration in minutes
        ]);

        $exercise = Exercise::create($validated);

        return response()->json($exercise, 201);
    }

    /**
     * PUT /api/exercises/{id} - Update exercise
     */
    public function update(Request $request, $id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json(['message' => 'Exercise not found'], 404);
        }

        $validated = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'type'        => 'sometimes|string',
        ]);

        $exercise->update($validated);

        return response()->json($exercise);
    }

    /**
     * DELETE /api/exercises/{id} - Delete exercise
     */
    public function destroy($id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json(['message' => 'Exercise not found'], 404);
        }

        $exercise->delete();

        return response()->json(['message' => 'Exercise deleted successfully']);
    }

    /**
     * GET /api/exercises/type/{type} - Filter by type ✨
     */
    public function filterByType($type)
    {
        $exercises = Exercise::where('type', $type)->get();

        if ($exercises->isEmpty()) {
            return response()->json(['message' => "No exercises found for type: $type"], 404);
        }

        return response()->json($exercises);
    }
}