<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->delete();

        $users = User::pluck('id')->all();

        $numOfUsers = count($users);

        foreach (Question::all() as $question) {
            for ($i = 0; $i < rand(0, $numOfUsers); $i++) {
                $user = $users[$i];
                $question->favorites()->attach($user);
            }
        }
    }
}