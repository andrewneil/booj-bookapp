<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use Sortable;
    //protected $fillable = ['author', 'title'];
    public $sortable = ['id', 'author', 'title', 'publication_date'];

    //Table Name
    protected $table = 'posts';
    // Primary Key 
    public $primaryKey = 'id';
    // Timestamp
    public $timestamp = true; // this is true by default 

    // This function means: A 'Post' has a Relationship with a 'User'
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
