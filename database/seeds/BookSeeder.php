<?php

use Illuminate\Database\Seeder;
use App\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'title' => 'Book 1',
                'description' => 'Description 1',
                'user_id'=>1
            ],
            [
                'title' => 'Book 2',
                'description' => 'Description 2',
                'user_id'=>1
            ],
            [
                'title' => 'Book 3',
                'description' => 'Description 3',
                'user_id'=>1
            ],
            [
                'title' => 'Book 4',
                'description' => 'Description 4',
                'user_id'=>1
            ]
        ];

        foreach ($books as $book) {
            Book::create([
                'title'=>$book['title'],
                'description'=>$book['description'],
                'user_id'=>$book['user_id'],
            ]);
        }

    }
}
