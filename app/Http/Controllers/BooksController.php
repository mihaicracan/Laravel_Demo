<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Tag;

class BooksController extends Controller
{
    /**
     * Show books view.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIndexView()
    {
        $books = Book::all();

        return view('books.index', [
            'books' => $books
        ]);
    }

    /**
     * Show add view.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showAddView()
    {   
        $authors = Author::all();
        $tags    = Tag::all();

        return view('books.add', [
            'authors' => $authors,
            'tags'    => $tags
        ]);
    }

    /**
     * Show edit view.
     *
     * @param int $id 
     * @return \Illuminate\Http\Response
     */
    public function showEditView($id)
    {
        $book    = Book::findOrFail($id);
        $authors = Author::all();
        $tags    = Tag::all();

        // Retrieve books ids tags
        $book->ids_tags = $book->tags->map(function($tag) {
            return $tag->id;
        });

        return view('books.edit', [
            'book'    => $book,
            'authors' => $authors,
            'tags'    => $tags
        ]);
    }

    /**
     * Add a new book.
     * 
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'tags' => 'required',
            'description'  => 'required',
            'cover' => 'mimes:jpeg,jpg,png,gif|required|max:4096'
        ]);

        $book = new Book;

        $book->title       = $request->title;
        $book->id_author   = $request->author;
        $book->description = $request->description;
        $book->cover       = $book->saveCover($request)->basename;
        $book->save();

        foreach ($request->tags as $id_tag) {
            $book->tags()->attach($id_tag);
        }

        return redirect('/books')->with('success', 'Book added.');
    }

    /**
     * Edit book.
     * 
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'tags' => 'required',
            'description'  => 'required'
        ]);

        $book = Book::find($id);
        $book->title       = $request->title;
        $book->id_author   = $request->author;
        $book->description = $request->description;
        $book->save();

        $book->tags()->detach();
        foreach ($request->tags as $id_tag) {
            $book->tags()->attach($id_tag);
        }

        return redirect('/books')->with('success', 'Book edited.');
    }

    /**
     * Delete book.
     * 
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        $book = Book::find($id);

        $book->tags()->detach();
        $book->delete();

        return redirect('/books')->with('success', 'Book deleted.');
    }

    /**
     * Rent book.
     * 
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function rent(Request $request, $id)
    {
        $book = Book::find($id);

        $book->rented      = true;
        $book->rented_from = $request->from;
        $book->rented_to   = $request->to;
        $book->id_renter   = Auth::user()->id;

        $book->save();

        return redirect('/books')->with('success', 'Book rented.');
    }

    /**
     * Cancel rent book.
     * 
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function unrent(Request $request, $id)
    {
        $book = Book::find($id);

        $book->rented      = false;
        $book->rented_from = NULL;
        $book->rented_to   = NULL;
        $book->id_renter   = NULL;

        $book->save();

        return redirect('/books')->with('success', 'Rent canceled.');
    }
}
