<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            'Diabetes',
            'Hepatites',
            'Hipertensión'
        ];

        foreach ($questions as $question) {
            $data = new Question();
            $data->description = $question;
            $data->save();
        }
    }
}
