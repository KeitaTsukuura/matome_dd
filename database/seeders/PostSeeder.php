<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => '青スパの心得',
            'body' => 'トーピードを投げてからサメライドを使う',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
