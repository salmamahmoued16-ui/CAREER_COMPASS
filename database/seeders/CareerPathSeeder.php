<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CareerPath;

class CareerPathSeeder extends Seeder
{
    public function run(): void
    {
        CareerPath::insert([

            [
                'title' => 'UX Designer',
                'description' => 'Design digital products and improve user experience.',
                'salary' => 90000,
                'growth' => 22,
                'duration' => '3-6 months',
                'work_type' => 'Remote Friendly',
                'image' => 'ux.png',
            ],

            [
                'title' => 'Backend Developer',
                'description' => 'Develop APIs and server-side applications.',
                'salary' => 100000,
                'growth' => 28,
                'duration' => '4-8 months',
                'work_type' => 'Hybrid',
                'image' => 'backend.png',
            ],

            [
                'title' => 'AI Engineer',
                'description' => 'Build machine learning and AI solutions.',
                'salary' => 130000,
                'growth' => 35,
                'duration' => '6-12 months',
                'work_type' => 'Remote',
                'image' => 'ai.png',
            ],

            [
                'title' => 'Data Analyst',
                'description' => 'Analyze data and create business insights.',
                'salary' => 85000,
                'growth' => 20,
                'duration' => '3-5 months',
                'work_type' => 'Office',
                'image' => 'data.png',
            ],
        ]);
    }
}
