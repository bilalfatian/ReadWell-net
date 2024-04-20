<?php

namespace Database\Seeders;
use Database\Seeders\BooksSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(BooksSeeder::class);
        // Call other seeders if needed
    }
}
