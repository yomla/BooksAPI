<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use app\Requests\StoreBook;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBook $request)
    {
        $book = new Book;
        $book->title = request()->input('title');
        $book->author = request()->input('author');
        $book->publish_year = request()->input('publish_year');
        $book->language = request()->input('language');
        $book->original_language = request()->input('original_language');
        $book->user_id = auth()->user()->id;
        $book->save();

        return $book;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBook $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());

        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return $book;
    }

    // Bonus task - Search Books by title and year
    
    public function searchByTitle($title) 
    {
        return Book::where('title', 'like', '%' . $title . '%')->paginate(10);
    }

    public function searchByYear($year)
    {
        return Book::where('year', 'like', '%' . $year . '%')->paginate(10);
    }
}
