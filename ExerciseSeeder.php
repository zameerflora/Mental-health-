<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/ExerciseSeeder.php
public function run(): void
{
    $exercises = [
        ['title' => 'Box breathing', 'type' => 'breathing', 'duration_minutes' => 5,
         'description' => 'Inhale 4s, hold 4s, exhale 4s, hold 4s. Reduces cortisol.', 'difficulty' => 'beginner'],
        ['title' => 'Body scan meditation', 'type' => 'mindfulness', 'duration_minutes' => 15,
         'description' => 'Gently bring attention to each part of the body without judgment.', 'difficulty' => 'beginner'],
        ['title' => 'Intuitive eating journal', 'type' => 'journaling', 'duration_minutes' => 10,
         'description' => 'Write about hunger cues, fullness, and emotions around food.', 'difficulty' => 'beginner'],
        ['title' => 'Mirror appreciation', 'type' => 'mindfulness', 'duration_minutes' => 5,
         'description' => 'Stand in front of a mirror and name 3 things you appreciate about your body.', 'difficulty' => 'intermediate'],
        ['title' => 'Gentle yoga flow', 'type' => 'movement', 'duration_minutes' => 20,
         'description' => 'A slow yoga sequence focused on body connection, not performance.', 'difficulty' => 'beginner'],
    ];

    foreach ($exercises as $exercise) {
        \App\Models\Exercise::create($exercise);
    }
}
}
