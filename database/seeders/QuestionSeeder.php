<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Option;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [

            [
                'question' => 'What subjects excite you the most?',
                'question_order' => 1,
                'options' => [
                    'Programming',
                    'Artificial Intelligence',
                    'Design',
                    'Business',
                ]
            ],

            [
                'question' => 'What type of work do you enjoy?',
                'question_order' => 2,
                'options' => [
                    'Building Applications',
                    'Analyzing Data',
                    'Designing Interfaces',
                    'Managing Projects',
                ]
            ],

            [
                'question' => 'Which skill describes you best?',
                'question_order' => 3,
                'options' => [
                    'Problem Solving',
                    'Creativity',
                    'Communication',
                    'Leadership',
                ]
            ],

            [
                'question' => 'What is your preferred work environment?',
                'question_order' => 4,
                'options' => [
                    'Office',
                    'Remote',
                    'Hybrid',
                    'Freelance',
                ]
            ],

            [
                'question' => 'What is your career goal?',
                'question_order' => 5,
                'options' => [
                    'Backend Developer',
                    'Frontend Developer',
                    'AI Engineer',
                    'UI/UX Designer',
                ]
            ],
        ];

        foreach ($questions as $q) {

            $question = Question::create([
                'question' => $q['question'],
                'question_order' => $q['question_order'],
            ]);

            foreach ($q['options'] as $option) {
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $option,
                ]);
            }
        }
    }
}
















