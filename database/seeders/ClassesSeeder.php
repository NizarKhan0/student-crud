<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::factory()
            ->count(10)
            ->sequence(fn($sequence) => [
                'name' => 'Class ' . ($sequence->index + 1),
            ])
            // Create related sections
            ->has(
                Section::factory()
                    ->count(2)
                    ->state(
                        new Sequence(
                            ['name' => 'Section A'],
                            ['name' => 'Section B'],
                        )
                    )
                    // Create related students within sections
                    ->has(
                        Student::factory()
                            ->count(5)
                            ->state(function (array $attributes, Section $section) {
                                return [
                                    'class_id' => $section->class_id,
                                    'section_id' => $section->id, // Assign the section ID correctly
                                ];
                            })
                    )
            )
            ->create();
    }
}
