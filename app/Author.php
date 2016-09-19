<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class Author extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'authors';

    /**
     * Get the books for the author.
     */
    public function books()
    {
        return $this->hasMany('App\Book', 'id_author');
    }
}
