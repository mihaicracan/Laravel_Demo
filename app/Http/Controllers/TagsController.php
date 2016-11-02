<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    /**
     * Show tags view.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIndexView()
    {
        $tags = Tag::all();

        return view('tags.index', [
            'tags' => $tags
        ]);
    }

    /**
     * Show add view.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showAddView()
    {
        return view('tags.add');
    }

    /**
     * Show edit view.
     *
     * @param int $id 
     * @return \Illuminate\Http\Response
     */
    public function showEditView($id)
    {
        $tag = Tag::findOrFail($id);

        return view('tags.edit', [
            'tag' => $tag
        ]);
    }

    /**
     * Add a new tag.
     * 
     * @param Request $request
     * @return Response
     */
    public function add(AddTagRequest $request)
    {
        $tag = new Tag;
        $tag->name        = $request->name;
        $tag->description = $request->description;
        $tag->save();

        return redirect('/tags')->with('success', 'Tag added.');
    }

    /**
     * Edit tag.
     * 
     * @param Request $request
     * @return Response
     */
    public function edit(EditTagRequest $request, $id)
    {
        $tag = Tag::find($id);
        $tag->name        = $request->name;
        $tag->description = $request->description;
        $tag->save();

        return redirect('/tags')->with('success', 'Tag edited.');
    }

    /**
     * Delete tag.
     * 
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        $tag = Tag::find($id);

        $tag->books()->detach();
        $tag->delete();

        return redirect('/tags')->with('success', 'Tag deleted.');
    }
}
