<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{

    public function __construct()
    {

        $this->middleware("auth:api")->except(["index", "show"]);

    }

    public function index()
    {

        $posts = Post::included()->filter()->sort()->getOrPaginate();

        return PostResource::collection($posts);

    }

    public function store(Request $request)
    {

        $data = $request->validate([

            "title" => "required",
            "url" => "required|unique:posts",
            "resume" => "required",
            "content" => "required",
            "category_id" => "required|exists:categories,id"

        ]);

        $user = auth()->user();

        $data["user_id"] = $user->id;

        $post = Post::create($data);

        return PostResource::make($post);

    }

    public function show($id)
    {

        $post = Post::included()->findOrFail($id);

        return PostResource::make($post);

    }

    public function update(Request $request, Post $post)
    {

        $request->validate([

            "title" => "required",
            "url" => "required|unique:posts,url,".$post->id,
            "resume" => "required",
            "content" => "required",
            "user_id" => "required|exists:users,id",
            "category_id" => "required|exists:categories,id"

        ]);

        $post->update($request->all());

        return PostResource::make($post);

    }

    public function destroy(Post $post)
    {

        $post->delete();

        return PostResource::make($post);

    }

}