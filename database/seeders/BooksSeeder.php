<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            [
                'user_id' => 1,
                'title' => 'Book 1',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'language' => 'English',
                'cover_image' => 'book1.jpg',
                'book_path' => 'book1.pdf',
                'approved' => true,
                'hidden' => false,
                'views' => 100,
                'average_rating' => 4.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Book 2',
                'content' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'language' => 'French',
                'cover_image' => 'book2.jpg',
                'book_path' => 'book2.pdf',
                'approved' => true,
                'hidden' => false,
                'views' => 200,
                'average_rating' => 3.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more dummy book records as needed
        ]);
    }
}
