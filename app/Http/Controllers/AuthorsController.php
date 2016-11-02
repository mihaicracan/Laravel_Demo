<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorsController extends Controller
{
    /**
     * Show authors view.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIndexView()
    {
        $authors = Author::all();

        return view('authors.index', [
            'authors' => $authors
        ]);
    }

    /**
     * Show add view.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showAddView()
    {
        return view('authors.add');
    }

    /**
     * Show edit view.
     *
     * @param int $id 
     * @return \Illuminate\Http\Response
     */
    public function showEditView($id)
    {
        $author = Author::findOrFail($id);

        return view('authors.edit', [
            'author' => $author
        ]);
    }

    /**
     * Add a new author.
     * 
     * @param Request $request
     * @return Response
     */
    public function add(AddAuthorRequest $request)
    {
        $author = new Author;
        $author->name        = $request->name;
        $author->description = $request->description;
        $author->save();

        return redirect('/authors')->with('success', 'Author added.');
    }

    /**
     * Edit author.
     * 
     * @param Request $request
     * @return Response
     */
    public function edit(EditAuthorRequest $request, $id)
    {
        $author = Author::find($id);
        $author->name        = $request->name;
        $author->description = $request->description;
        $author->save();

        return redirect('/authors')->with('success', 'Author edited.');
    }

    /**
     * Delete author.
     * 
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        $author = Author::find($id);

        foreach ($author->books as $book) {
            $book->tags()->detach();
            $book->delete();
        }
        
        $author->delete();

        return redirect('/authors')->with('success', 'Author deleted.');
    }
}
