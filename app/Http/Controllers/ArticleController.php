<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use App\Category;
use Auth;
use Validator;

class ArticleController extends Controller
{
    /**
     * Construct the controller
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['getIndex', 'getShow']]);
    }

    /**
     * Return all all articles
     */
    public function getIndex(Request $request)
    {        
        $articles = Article::where('active', 1);

        /**
         * Filter by category
         */
        if ($request->has('category')) {
            $filter_category = $request->get('category');
            
            $category = Category::find($filter_category);
            
            // if there is no category with this name
            if (!$category) return response()->json([
                'code' => '404',
                'message' => 'There is no category with this id'
            ], 404);

            // if category is exists
            $articles = $category->articles();

        }

        /**
         * Filter by order
         */
        if ($request->has('order')) {
            $fitler_order = $request->get('order');

            if ($fitler_order == 'desc' || $fitler_order == 'asc') {

                $articles->orderBy('views', $fitler_order);

            }
        }

        return response()->json([
            'code' => '200',
            'data' => $articles->get()
        ], 200);
    }

    /**
     * Return just the needed article.
     */
    public function getShow(Request $request)
    {
        if (!$request->has('id')) return response()->json([
            'code' => '404',
            'message' => 'You must provide an id to get the article'
        ], 404);


        $article = Article::findOrResponse($request->get('id'));
        $article->categories; // include categories with the article

        return response()->json([
            'code' => '200',
            'data' => $article
        ], 200);

        // TODO: add views counter
    }

    /**
     * Create new Article
     */
    public function postCreate(Request $request)
    {
        $user = Auth::user();
        
        $rules = [
            'title' => 'required|min:3|max:500',
            'body' => 'required|min:3',
            'category' => 'array|numeric_array|array_exists:categories,id'
        ];
        
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'code' => '400',
                'message' => 'Validation Failed',
                'data' => $validation->errors()
            ], 400);
        }

        $article = new Article([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        // add the article to its user.
        $user->articles()->save($article);
        
        // add the article to its categories.
        if ($request->has('category')) {
            $article->categories()->attach($request->get('category'));
        }

        return response()->json([
            'code' => '200',
            'message' => 'Article Created Successfully'
        ], 200);

        // TODO: Create url from the name of the article.
    }


    /**
     * Update Article
     */
    public function postUpdate(Request $request)
    {
        if (!$request->has('id')) 
            return response()->json([
                'code' => '400',
                'message' => 'You must specify an id'
            ], 400);

        $user = Auth::user();
        $article = Article::findOrResponse($request->get('id'));

        if ($user->id != $article->user_id)
            return response()->json([
                'code' => '401',
                'message' => 'You are not authorized to update this article.'
            ], 401);
        
        $rules = [
            'title' => 'min:3|max:500',
            'body' => 'min:3',
            'category' => 'array|numeric_array|array_exists:categories,id'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails())
            return response()->json([
                'code' => '400',
                'message' => 'Validation Failed',
                'data' => $validation->errors()
            ], 400);

        if ($request->has('title'))
            $article->title = $request->get('title');

        if ($request->has('body'))
            $article->body = $request->get('body');
            
        if ($request->has('category'))
            $article->categories()->sync($request->get('category'));

        if ($article->save()) {
            return response()->json([
                'code' => '200',
                'message' => 'Article updated successfully.'
            ], 200);
        }else {
            return response()->json([
                'code' => '500',
                'message' => 'Error when saving the article.'
            ], 500);
        }
    }

    /**
     * Remove Article by id
     */
    public function postDelete(Request $request)
    {
        if (!$request->has('id'))
            return response()->json([
                'code' => '400',
                'message' => 'You must specify an id'
            ], 400);

        $rules = [
            'id' => 'numeric|exists:articles,id'
        ];

        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails())
            return response()->json([
                'code' => '400',
                'message' => 'Validation Failed',
                'data' => $validation->errors()
            ], 400);

        $user = Auth::user();
        $article = Article::findOrResponse($request->get('id'));
        
        if ($user->id != $article->user_id)
            return response()->json([
                'code' => '401',
                'message' => 'You are not authorized to delete this article.'
        ], 401);
        
        $article->categories()->detach();
        $article->delete();

        return response()->json([
            'code' => '200',
            'message' => 'Article removed successfully.'
        ], 200);
    }
}
