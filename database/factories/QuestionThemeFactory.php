<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionTheme>
 */
class QuestionThemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'title_size' => $this->faker->randomElement([14, 16, 18, 20, 22, 24, 26, 30, 40, 50, 60, 70, 80, 90, 100]),
            'title_color' => $this->faker->hexColor(),
            'title_align' => $this->faker->randomElement(['left', 'right', 'center']),
            'title_font' => $this->faker->randomElement(['Times New Roman', 'Courier New', 'Courier', 'Arial Black']),
            'text_size' => $this->faker->randomElement([14, 16, 18, 20, 22, 24, 26, 30, 40, 50, 60, 70, 80, 90, 100]),
            'text_color' => $this->faker->hexColor(),
            'text_align' => $this->faker->randomElement(['left', 'right', 'center']),
            'text_font' => $this->faker->randomElement(['Times New Roman', 'Courier New', 'Courier', 'Arial Black']),
            'image_align' => $this->faker->randomElement(['left', 'right', 'center', 'justify']),
            'image_size' => $this->faker->randomElement(['100', '50', '75', '25']),
            'bg_color' => $this->faker->rgbColor(),
            'container_color' => $this->faker->hexColor(),
            'border' => "1px solid #000",
        ];
    }
}
