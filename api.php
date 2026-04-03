<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ReflectionController;

/*
 * Mental Wellness Platform API Routes
 * All routes are prefixed with /api automatically by Laravel
 */

// === STORIES (healing stories community) ===
Route::apiResource('stories', StoryController::class);

// Extra: get stories by category — e.g. GET /api/stories/category/stress
Route::get('stories/category/{category}', [StoryController::class, 'byCategory']);

// === EXERCISES (wellness & body exercises) ===
Route::apiResource('exercises', ExerciseController::class);

// Extra: filter by type — GET /api/exercises/type/breathing
Route::get('exercises/type/{type}', [ExerciseController::class, 'byType']);

// === USERS ===
Route::apiResource('users', UserController::class);

// Extra: get all reflections for a specific user
Route::get('users/{id}/reflections', [ReflectionController::class, 'byUser']);

// Extra: get all stories for a specific user
Route::get('users/{id}/stories', [StoryController::class, 'byUser']);

// === REFLECTIONS (body image & food journal) ===
Route::apiResource('reflections', ReflectionController::class);
