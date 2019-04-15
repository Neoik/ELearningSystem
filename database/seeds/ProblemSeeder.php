<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
      factory(App\Problem::class, 50)->create()->each(function($p) {
        factory(App\ProblemIOTest::class, 5)->create([
          'problem_id' => $p,
        ]);
        factory(App\ProblemIOExample::class, 5)->create([
          'problem_id' => $p,
        ]);
      });
        */
        $this->problem1();
        $this->problem2();
        $this->problem3();
        $this->problem4();
        $this->problem5();
        $this->problem6();
    }

    private function problem1() {
        factory(App\Problem::class, 1)->create([ 'name' => 'A + B',
            'description' => 'Find sum of two integers',
            'input_description' => 'The first line of input contains two integers N, separated with space, N < 10^9.',
            'output_description' => 'Output one number - sum of two integers.',
            'max_mem' => 16,
            'max_time' => 1,
            'submit_count' => 0,
            'solve_count' => 0,
        ])->each(function($p) {
            factory(App\ProblemIOExample::class, 1)->create([ 'input' => '1 2', 'output' => '3', 'problem_id' => $p, ]);

            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 2', 'output' => '3', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '5 6', 'output' => '11', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '100 30000', 'output' => '30100', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '100 30', 'output' => '130', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 37', 'output' => '38', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 99999', 'output' => '100000', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 30', 'output' => '31', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '100500 37', 'output' => '100537', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '100500 501', 'output' => '101001', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '100500 300', 'output' => '100800', 'problem_id' => $p, ]);
        });
    }

    private function problem2() {
        factory(App\Problem::class, 1)->create([ 'name' => 'Numbers',
            'description' => 'Find sum of integers from 1 to N included',
            'input_description' => 'The first line of input contains two integers N, separated with space, N < 10^9.',
            'output_description' => 'Output one number - sum of integers from 1 to N included',
            'max_mem' => 16,
            'max_time' => 1,
            'submit_count' => 0,
            'solve_count' => 0,
        ])->each(function($p) {
            factory(App\ProblemIOExample::class, 1)->create([ 'input' => '4', 'output' => '10', 'problem_id' => $p, ]);
            factory(App\ProblemIOExample::class, 1)->create([ 'input' => '5', 'output' => '15', 'problem_id' => $p, ]);

            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '10', 'output' => '55', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '100', 'output' => '5050', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '103', 'output' => '5356', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '228', 'output' => '26106', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1337', 'output' => '894453', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '322', 'output' => '52003', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '19', 'output' => '190', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '90', 'output' => '4095', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '9999', 'output' => '49995000', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2', 'output' => '3', 'problem_id' => $p, ]);
        });
    }
    private function problem3() {
        factory(App\Problem::class, 1)->create([ 'name' => 'Watermelon',
        'description' => '
        One hot summer day Pete and his friend Billy decided to buy a watermelon. They chose the biggest and the ripest one, in their opinion. After that the watermelon was weighed, and the scales showed w kilos. They rushed home, dying of thirst, and decided to divide the berry, however they faced a hard problem.
        
        Pete and Billy are great fans of even numbers, that\'s why they want to divide the watermelon in such a way that each of the two parts weighs even number of kilos, at the same time it is not obligatory that the parts are equal. The boys are extremely tired and want to start their meal as soon as possible, that\'s why you should help them and find out, if they can divide the watermelon in the way they want. For sure, each of them should get a part of positive weight.',
        'input_description' => 'The first (and the only) input line contains integer number w (1 ≤ w ≤ 100) — the weight of the watermelon bought by the boys.',
        'output_description' => 'Print YES, if the boys can divide the watermelon into two parts, each of them weighing even number of kilos; and NO in the opposite case.',
        'max_mem' => 64,
        'max_time' => 1,
        'submit_count' => 0,
        'solve_count' => 0,
        ])->each(function($p) {
            factory(App\ProblemIOExample::class, 1)->create([ 'input' => '8', 'output' => 'YES', 'problem_id' => $p, ]);

            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '8', 'output' => 'YES', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1', 'output' => 'NO', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2', 'output' => 'NO', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '3', 'output' => 'NO', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '4', 'output' => 'YES', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '5', 'output' => 'NO', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '6', 'output' => 'YES', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '7', 'output' => 'NO', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '9', 'output' => 'NO', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '80', 'output' => 'YES', 'problem_id' => $p, ]);
        });
    }
    private function problem4() {
        factory(App\Problem::class, 1)->create([ 'name' => 'Theatre Square',
        'description' => 'Theatre Square in the capital city of Berland has a rectangular shape with the size n × m meters. On the occasion of the city\'s anniversary, a decision was taken to pave the Square with square granite flagstones. Each flagstone is of the size a × a.

        What is the least number of flagstones needed to pave the Square? It\'s allowed to cover the surface larger than the Theatre Square, but the Square has to be covered. It\'s not allowed to break the flagstones. The sides of flagstones should be parallel to the sides of the Square.',
        'input_description' => 'The input contains three positive integer numbers in the first line: n,  m and a (1 ≤  n, m, a ≤ 10^9).',
        'output_description' => 'Write the needed number of flagstones.',
        'max_mem' => 256,
        'max_time' => 1,
        'submit_count' => 0,
        'solve_count' => 0,
        ])->each(function($p) {
            factory(App\ProblemIOExample::class, 1)->create([ 'input' => '6 6 4', 'output' => '4', 'problem_id' => $p, ]);

            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '6 6 4', 'output' => '4', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 1 1', 'output' => '1', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2 1 1', 'output' => '2', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 2 1', 'output' => '2', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2 2 1', 'output' => '4', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2 1 2', 'output' => '1', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 1 3', 'output' => '1', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1000000000 1000000000 1', 'output' => '1000000000000000000', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '12 13 4', 'output' => '12', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '222 332 5', 'output' => '3015', 'problem_id' => $p, ]);
        });
    }
    private function problem5() {
        $description = 'Petya started to attend programming lessons. On the first lesson his task was to write a simple program. The program was supposed to do the following: in the given string, consisting if uppercase and lowercase Latin letters, it:

- deletes all the vowels,
- inserts a character "." before each consonant,
- replaces all uppercase consonants with corresponding lowercase ones.
Vowels are letters "A", "O", "Y", "E", "U", "I", and the rest are consonants. The program\'s input is exactly one string, it should return the output as a single string, resulting after the program\'s processing the initial string.

Help Petya cope with this easy task.';
        factory(App\Problem::class, 1)->create([ 'name' => 'String Task',
        'description' => $description,
        'input_description' => 'The first line represents input string of Petya\'s program. This string only consists of uppercase and lowercase Latin letters and its length is from 1 to 100, inclusive.',
        'output_description' => 'Print the resulting string. It is guaranteed that this string is not empty.',
        'max_mem' => 256,
        'max_time' => 2,
        'submit_count' => 0,
        'solve_count' => 0,
        ])->each(function($p) {
            factory(App\ProblemIOExample::class, 1)->create([ 'input' => 'tour', 'output' => '.t.r', 'problem_id' => $p, ]);
            factory(App\ProblemIOExample::class, 1)->create([ 'input' => 'aBAcAba', 'output' => '.b.c.b', 'problem_id' => $p, ]);

            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'tour', 'output' => '.t.r', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'aBAcAba', 'output' => '.b.c.b', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'obn', 'output' => '.b.n', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'wpwl', 'output' => '.w.p.w.l', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'ggdvq', 'output' => '.g.g.d.v.q', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'pumesz', 'output' => '.p.m.s.z', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'g', 'output' => '.g', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'zjuotps', 'output' => '.z.j.t.p.s', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'jzbwuehe', 'output' => '.j.z.b.w.h', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => 'tnkgwuugu', 'output' => '.t.n.k.g.w.g', 'problem_id' => $p, ]);
        });
    }
    private function problem6() {
        $description = 'You are given a rectangular board of M × N squares. Also you are given an unlimited number of standard domino pieces of 2 × 1 squares. You are allowed to rotate the pieces. You are asked to place as many dominoes as possible on the board so as to meet the following conditions:

1. Each domino completely covers two squares.

2. No two dominoes overlap.

3. Each domino lies entirely inside the board. It is allowed to touch the edges of the board.

Find the maximum number of dominoes, which can be placed under these restrictions.';
        factory(App\Problem::class, 1)->create([ 'name' => 'Domino piling',
        'description' => $description,
        'input_description' => 'In a single line you are given two integers M and N — board sizes in squares (1 ≤ M ≤ N ≤ 16)',
        'output_description' => 'Output one number — the maximal number of dominoes, which can be placed.',
        'max_mem' => 256,
        'max_time' => 2,
        'submit_count' => 0,
        'solve_count' => 0,
        ])->each(function($p) {
            factory(App\ProblemIOExample::class, 1)->create([ 'input' => '2 4', 'output' => '4', 'problem_id' => $p, ]);
            factory(App\ProblemIOExample::class, 1)->create([ 'input' => '3 3', 'output' => '4', 'problem_id' => $p, ]);

            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2 4', 'output' => '4', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '3 3', 'output' => '4', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 5', 'output' => '2', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 6', 'output' => '3', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 15', 'output' => '7', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '1 16', 'output' => '8', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2 5', 'output' => '5', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2 6', 'output' => '6', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2 7', 'output' => '7', 'problem_id' => $p, ]);
            factory(App\ProblemIOTest::class, 1)->create([ 'input' => '2 14', 'output' => '14', 'problem_id' => $p, ]);
        });
    }
}
