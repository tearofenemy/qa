<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Question::class, 3)->create()->each(function ($u) {
            $u->questions()
                ->saveMany(
                    factory(Question::class, rand(1, 5))->make()
                );
        });
    }
}