<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;



        $post = [];
        if ($request->all()) {
            $post = Post::join('categories', 'posts.category_id', '=', 'categories.id')->search($search)->get(['posts.*', "categories.title as category_title", "categories.description as category_description"]);
        } else {
            $post =  Post::join('categories', 'posts.category_id', '=', 'categories.id')
                ->get(['posts.*', "categories.title as category_title", "categories.description as category_description"]);
        }



        if (count($post) < 1) {
            return response()->json([
                "message" => "Data not found",
                "success" => false,
            ], 401);
        }

        return response()->json([
            "message" => "Data show",
            "success" => true,
            "post" => $post
        ], 200);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "title" => 'required|string',
            "description" => 'required',
            "category_id" => 'required',
            "thumbnail" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors(),
                "success" => false,
                "product" => []
            ], 406);
        }

        $category = Category::find($request->category_id);


        if (!$category) {
            return response()->json([
                "message" => "Category not found",
                "success" => false,
            ], 401);
        }


        try {

            $data = [
                "title" => Str::slug(strtolower($request->title)),
                "description" => $request->description,
                "category_id" => $request->category_id,
                "pubDate" => Carbon::now(),
                "thumbnail" => $request->thumbnail,
                "link" => URL::to("/") . "/" . strtolower($category->title) . "/" . Str::slug(strtolower($request->title))
            ];

            $post = Post::create($data);

            return response()->json([
                "message" => "Data created",
                "success" => true,
                "post" => $post
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
                "success" => false,
            ], 401);
        }
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            "title" => 'required|string',
            "description" => 'required',
            "category_id" => 'required',
            "thumbnail" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors(),
                "success" => false,
                "product" => []
            ], 406);
        }

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                "message" => "Category not found",
                "success" => false,
            ], 401);
        }


        $category = Category::find($request->category_id);


        if (!$category) {
            return response()->json([
                "message" => "Category not found",
                "success" => false,
            ], 401);
        }

        try {

            $data = [
                "title" => Str::slug(strtolower($request->title)),
                "description" => $request->description,
                "category_id" => $request->category_id,
                "pubDate" => Carbon::now(),
                "thumbnail" => $request->thumbnail,
                "link" => URL::to("/") . "/" . strtolower($category->title) . "/" . Str::slug(strtolower($request->title))
            ];

            $post->update($data);

            return response()->json([
                "message" => "Data updated",
                "success" => true,
                "post" => $post
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
                "success" => false,
            ], 401);
        }
    }

    public function delete(Request $request, $id)
    {

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                "message" => "Data not found",
                "success" => false,
            ]);
        }
        $post->delete();

        return response()->json([
            "message" => "Data deleted",
            "success" => true,
            "post" => $post
        ]);
    }
}
