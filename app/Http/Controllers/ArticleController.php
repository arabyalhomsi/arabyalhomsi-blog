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

        return response()->json($articles->get());
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

        return $article;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function postCreate(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'title' => 'required|min:3|max:500',
            'body' => 'required|min:3'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'code' => '400',
                'message' => 'Validation Error',
                'data' => $validation->errors()
            ], 400);
        }

        $article = new Article([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        $user->articles()->save($article);
        
        return response()->json([
            'code' => '200',
            'message' => 'Article Created Successfully'
        ], 200);

        // todo: add categories support
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postDestroy($id)
    {
        //
    }
}
