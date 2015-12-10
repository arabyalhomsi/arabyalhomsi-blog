<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function()
{
	/**
	 * Authenticate Route
	 * @example "POST /authenticate?email=info@gmail.com&password=secret" Login and Retrieve user token.
	 */
	Route::post('authenticate', 'AuthenticateController@authenticate');

	/**
	 * Article Route
	 * @example
	 * "GET /article?category=1&order=desc" Retrieve all Articles.
	 * "GET /article/show?id=1" Retrieve one article.
	 * "POST /article/create?title=araby&body=content&category[]=1&category[]=2" Create Article.
	 * "POST /article/update?id=1&title=araby&body=content&category[]=1&category[]=2" Create Article.
	 * "POST /article/delete?id=1" Create Article.
	 */
	Route::controller('article', 'ArticleController');

	/**
	 * Category Route
	 * @example
	 * "GET /category?order=desc" Retrieve all Categories.
	 * "POST /category/create?title=programming" Create new category
	 * "POST /category/update?id=1&title=programming"
	 * "POST /category/delete?id=1"
	 */
	Route::controller('category', 'CategoryController');
});