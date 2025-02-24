<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $questions = Question::all()->pluck('id')->toArray();
        return [
            'question_id' => $this->faker->randomElement(Question::all()->pluck('id')->toArray()),
            'next_question_id' => $this->faker->randomElement([null, ...$questions ]),
            'image' => $this->faker->randomElement([null, 'storage/options/option.jgp']),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
