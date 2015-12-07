<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
	 * The database table used by the model.
	 * @var string
	 */
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'views', 'user_id', 'active'];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['deleted_at', 'active'];

    /**
     * The Categories that belong to the Article.
     */
    public function categories() 
    {
        return $this->belongsToMany('App\Category');
    }

    public static function findOrResponse($id) {
        $article = self::find($id);
        
        if (!$article)
            return response()->json([
            'code' => '404',
            'message' => 'could not find an article'
        ], 404);

        return $article;
    }
}
