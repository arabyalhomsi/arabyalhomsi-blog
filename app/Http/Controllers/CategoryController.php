<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('jwt.auth', ['except' => ['getIndex']]);
    }

    public function getIndex()
    {
    	$categories = Category::all();
    	return $categories; 
    }

    public function postCreate(Request $request)
    {
    	if (!$request->has('title'))
    		return response()->json([
    			'message' => 'You must specify a title.'
    		], 400);

    	Category::create([
    		'title' => $request->get('title')
    	]);

    	return response()->json([
    		'message' => 'Category Created Successfully.'
    	], 200);
    }

    public function postUpdate(Request $request)
    {
		if (!$request->has('title') || !$request->has('id'))
			return response()->json([
				'message' => 'You must specify an id, and a title.'
			], 400);

		$category = Category::findOrFail($request->get('id'));
		$category->title = $request->get('title');

		$category->save();

		return response()->json([
			'message' => 'Category Updated Successfully.'
		], 200);
    }

    public function postDelete(Request $request)
    {
		if (!$request->has('id'))
			return response()->json([
				'message' => 'You must specify an id.'
			], 400);

		$category = Category::findOrFail($request->get('id'));
		$category->articles()->detach();
		$category->delete();

		return response()->json([
			'message' => 'Category removed successfully.'
		], 200);
    }
}
