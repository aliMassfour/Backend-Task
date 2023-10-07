<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            'title' => 'this is the first article',
            'body' => 'this is the first body',
            'image' => 'images/12.jpg',
            'created_at' => now()
        ]);
    }
}
