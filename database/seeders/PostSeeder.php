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
            'title' => '赤スパの心得1',
            'body' => 'ビーコンを切らさない',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'category_id' => 1,
        ]);
        DB::table('posts')->insert([
            'title' => '赤スパの心得2',
            'body' => 'とにかく耐える',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'category_id' => 1,
        ]);
        DB::table('posts')->insert([
            'title' => '青スパの心得1',
            'body' => 'トーピードを投げてからサメライドを使う',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'category_id' => 2,
        ]);
        DB::table('posts')->insert([
            'title' => '青スパの心得2',
            'body' => 'サメライドはエリアを取り切れるときに使う',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'category_id' => 2,
        ]);
        DB::table('posts')->insert([
            'title' => 'Xマッチの心得',
            'body' => 'イライラせず常に冷静に',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'category_id' => 3,
        ]);
        DB::table('posts')->insert([
            'title' => 'ギアについて',
            'body' => 'みんなのギアを参考にしよう(これから追加される機能)',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'category_id' => 3,
        ]);
    }
}
