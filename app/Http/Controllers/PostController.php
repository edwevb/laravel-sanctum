<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::latest()->paginate(5);
            $data = PostResource::collection($posts);
            return response()->json(['data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post)
    {
        try {
            $post = Post::firstWhere('id', 'asdsd');
        } catch (\Exception $th) {
            return response()->json(['Error' => $th->getMessage()]);
        }
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
