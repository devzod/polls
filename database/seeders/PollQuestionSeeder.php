<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\PollQuestion;
use App\Models\Question;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PollQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polls = Poll::all();
        $questions = Question::query()->pluck('id')->toArray();;

        foreach ($polls as $poll) {
            $randomQuestions = collect($questions)->shuffle()->take(5);
            foreach ($randomQuestions as $questionId) {
                PollQuestion::query()->create([
                    'poll_id' => $poll->id,
                    'question_id' => $questionId,
                ]);
            }
        }
    }
}
