<?php
namespace App\Http\Controllers;

use App\Models\Story;
use App\Http\Resources\StoryResource;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * GET /api/stories — return all stories
     */
    public function index()
    {
        $stories = Story::with('user')->latest()->get();
        return StoryResource::collection($stories);
    }

    /**
     * GET /api/stories/{id} — return a single story
     */
    public function show($id)
    {
        $story = Story::with('user')->find($id);

        if (!$story) {
            return response()->json(['message' => 'Story not found'], 404);
        }

        return new StoryResource($story);
    }

    /**
     * POST /api/stories — create a new story
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'category'     => 'required|in:body_image,food_relationship,stress,recovery',
            'is_anonymous' => 'boolean',
        ]);

        $story = Story::create($validated);
        return new StoryResource($story);
    }

    /**
     * PUT /api/stories/{id} — update a story
     */
    public function update(Request $request, $id)
    {
        $story = Story::find($id);

        if (!$story) {
            return response()->json(['message' => 'Story not found'], 404);
        }

        $validated = $request->validate([
            'title'        => 'sometimes|string|max:255',
            'content'      => 'sometimes|string',
            'category'     => 'sometimes|in:body_image,food_relationship,stress,recovery',
            'is_anonymous' => 'boolean',
        ]);

        $story->update($validated);
        return new StoryResource($story);
    }

    /**
     * DELETE /api/stories/{id} — remove a story
     */
    public function destroy($id)
    {
        $story = Story::find($id);

        if (!$story) {
            return response()->json(['message' => 'Story not found'], 404);
        }

        $story->delete();
        return response()->json(['message' => 'Story deleted successfully']);
    }
}