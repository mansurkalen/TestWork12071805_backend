<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::get();

        return  response()->json([
            'success' => true,
            'books' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|required',
            'author' => 'string|required',
            'year' => 'integer|required'
        ]);

        if(Book::create($request->all())){

            return  response()->json([
                'success' => true
            ]);
        }

        return  response()->json([
            'success' => false,
            'message' => 'Failure'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        if($book){
            return  response()->json([
                'success' => true,
                'book' => $book
            ]);
        }

        return  response()->json([
            'success' => false,
            'message' => 'Book not found'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        if($book){

            $request->validate([
                'title' => 'string|required',
                'author' => 'string|required',
                'year' => 'integer|required'
            ]);

            if($book->update($request->all())) {

                return response()->json([
                    'success' => true,
                ]);
            }

            return  response()->json([
                'success' => false,
                'message' => 'Failure'
            ]);

        }

        return  response()->json([
            'success' => false,
            'message' => 'Book not found'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if($book){

            $book->delete();

            $books = Book::get();

            return  response()->json([
                'success' => true,
                'books' => $books
            ]);
        }

        return  response()->json([
            'success' => false,
            'message' => 'Book not found'
        ]);
    }
}
