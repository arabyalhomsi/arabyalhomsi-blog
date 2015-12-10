<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * The database table used by the model.
	 * @var string
	 */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * The Categories that belong to the Article.
     */
    public function articles() 
    {
        return $this->belongsToMany('App\Article');
    }
}