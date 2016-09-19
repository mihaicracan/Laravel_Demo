<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Author;
use App\Tag;
use Image;

class Book extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * Get the author that owns the book.
     */
    public function author()
    {
        return $this->belongsTo('App\Author', 'id_author');
    }

    /**
     * The tags that belong to the book.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'book_tag', 'id_book', 'id_tag');
    }

    /**
     * Save cover for this book
     * 
     * @param  Request $request
     * @return Image
     */
    public function saveCover($request)
    {	
    	$file = $request->file('cover');
    	$name = md5(time()) . '.' . $file->extension();

    	$cover = Image::make($request->file('cover'))->widen(200)->save('images/covers/' . $name);

    	return $cover;
    }

    /**
     * Retrieve cover URL
     *
     * @return string
     */
    public function coverURL()
    {
    	return url('/images/covers/' . $this->cover);
    }
}
