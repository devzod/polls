<?php

namespace Database\Factories;

use App\Models\Poll;
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
            'poll_id' => $this->faker->randomElement(Poll::all()->pluck('id')->toArray()),
            'question_theme_id' => $this->faker->randomElement(QuestionTheme::all()->pluck('id')->toArray()),
            'type' => $this->faker->randomElement(['text', 'image', 'radio', 'multiple', 'video']),
            'image' => $this->faker->randomElement([null, 'storage/questions/question.jgp']),
            'video' => $this->faker->randomElement([null, $this->faker->imageUrl()]),
            'bg_image' => $this->faker->randomElement([null, 'storage/questions/bg_image.jgp']),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
