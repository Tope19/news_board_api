<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            DB::table('posts')->insert([
                'title' => 'Post ' . $i,
                'link' => 'https://www.google.com/',
                'creation_date' => '2020-04-27',
                'upvotes' => $i,
                'author_name' => 'Author ' . $i,
            ]);
        }
    }
}
