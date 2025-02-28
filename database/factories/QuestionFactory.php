<?php

namespace Database\Factories;

use App\Models\QuestionTheme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_theme_id' => $this->faker->randomElement(QuestionTheme::all()->pluck('id')->toArray()),
            'type' => $this->faker->randomElement(['text', 'image', 'radio', 'multiple']),
            'image' => $this->faker->randomElement([null, 'questions/question.jpg']),
            'video' => $this->faker->randomElement([null, $this->faker->imageUrl()]),
            'bg_image' => $this->faker->randomElement([null, 'questions/bg_image.jpg']),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
