<?php

use Illuminate\Database\Seeder;

class ProblemSumbissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*
        $u = App\User::inRandomOrder()->first();
        $p = App\Problem::inRandomOrder()->first();
        */
        factory(App\ProblemSumbission::class, 50)->make()->each(function($p){
          $p->problem_id = App\Problem::inRandomOrder()->first()->id;
          $p->user_id = App\User::inRandomOrder()->first()->id;
          $p->save();
        });
/*
        [
          'problem_id' => App\Problem::inRandomOrder()->first(),
          'user_id' => App\User::inRandomOrder()->first(),
        ]);
        */
    }
}
