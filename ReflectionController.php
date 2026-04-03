<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use Illuminate\Http\Request;

class ReflectionController extends Controller
{
    /**
     * GET /api/reflections - Get all reflections
     */
    public function index()
    {
        return response()->json(Reflection::all());
    }

    /**
     * GET /api/reflections/{id} - Get single reflection
     */
    public function show($id)
    {
        $reflection = Reflection::find($id);

        if (!$reflection) {
            return response()->json(['message' => 'Reflection not found'], 404);
        }

        return response()->json($reflection);
    }

    /**
     * POST /api/reflections - Create a new reflection
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'                => 'required|exists:users,id',
            'exercise_id'            => 'nullable|exists:exercises,id',
            'body_image_note'        => 'nullable|string',
            'food_relationship_note' => 'nullable|string',
            'stress_note'            => 'nullable|string',
            'mood_score'             => 'nullable|integer|min:1|max:10',
            'entry_date'             => 'required|date',
        ]);

        $reflection = Reflection::create($validated);

        return response()->json($reflection, 201);
    }

    /**
     * PUT /api/reflections/{id} - Update a reflection
     */
    public function update(Request $request, $id)
    {
        $reflection = Reflection::find($id);

        if (!$reflection) {
            return response()->json(['message' => 'Reflection not found'], 404);
        }

        $validated = $request->validate([
            'exercise_id'            => 'sometimes|nullable|exists:exercises,id',
            'body_image_note'        => 'sometimes|nullable|string',
            'food_relationship_note' => 'sometimes|nullable|string',
            'stress_note'            => 'sometimes|nullable|string',
            'mood_score'             => 'sometimes|nullable|integer|min:1|max:10',
            'entry_date'             => 'sometimes|date',
        ]);

        $reflection->update($validated);

        return response()->json($reflection);
    }

    /**
     * DELETE /api/reflections/{id} - Delete a reflection
     */
    public function destroy($id)
    {
        $reflection = Reflection::find($id);

        if (!$reflection) {
            return response()->json(['message' => 'Reflection not found'], 404);
        }

        $reflection->delete();

        return response()->json(['message' => 'Reflection deleted successfully']);
    }

    /**
     * GET /api/users/{id}/reflections - Get all reflections for a user
     */
    public function byUser($userId)
    {
        $reflections = Reflection::where('user_id', $userId)->get();

        if ($reflections->isEmpty()) {
            return response()->json(['message' => 'No reflections found for this user'], 404);
        }

        return response()->json($reflections);
    }
}
