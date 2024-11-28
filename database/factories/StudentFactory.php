<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'class_id' => null, // This will be set by the seeder
            'section_id' => Section::factory(), // Automatically generate or use an existing section
        ];
    }
}
