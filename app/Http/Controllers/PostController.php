<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::latest()->paginate(5);
            $data = PostResource::collection($posts);
            return response()->json([
                'message' => 'Data fetched successfully',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ]], 500);
        }
    }

    public function store(StorePostRequest $request)
    {
        $input = $request->validated();
        try {
            $post = Post::create($input);
            $data = new PostResource($post);
            return response()->json([
                'message' => 'Data added successfully',
                'data' => $data
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ]], 500);
        }
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $input = $request->validated();
            $post->update($input);
            return $post;
            $data = new PostResource($post);
            return response()->json([
                'message' => 'Data updated successfully',
                'data' => $data
            ], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ]], 500);
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return response()->json([
                'message' => 'Data deleted successfully',
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ]);
        }
    }
}
