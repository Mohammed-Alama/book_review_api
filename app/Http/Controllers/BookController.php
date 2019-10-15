<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * BookController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return BookResource::collection(Book::with('ratings')->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return BookResource
     */
    public function store(Request $request)
    {
        //Validation First

        $book = Book::create([
            'user_id'=>$request->user()->id,
            'title'=>$request->title,
            'description'=>$request->description
        ]);

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return BookResource
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return BookResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request,Book $book)
    {
        if ($request->user()->id !== $book->user_id){
            return response()->json(['error'=>'You can only edit your own book'],403);
        }

        $book->update($request->only(['title','description']));

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null,204);
    }
}
