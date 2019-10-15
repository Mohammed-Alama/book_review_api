<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResource;
use App\Rating;
use App\Book;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * RatingController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     * @param Book $book
     * @return RatingResource
     */
    public function store(Request $request , Book $book)
    {
        $rating = Rating::firstOrCreate([
           'user_id'=>$request->user()->id,
           'book_id'=>$book->id
        ],['rating'=>$request->rating]);

        return new RatingResource($rating);
    }
}
