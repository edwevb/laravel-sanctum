<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::with(['author', 'tags'])->paginate(10);
            $response = PostResource::collection($posts)->additional([
                'message' => 'Get data successfully'
            ])->response()->setStatusCode(200);
            return $response;
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
            Post::create($input);
            return response()->json([
                'message' => 'Data added successfully',
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
        try {
            $response =  (new PostResource(
                $post->loadMissing(['author', 'tags'])
            ))->additional([
                'message' => 'Get data successfully'
            ])->response()->setStatusCode(200);

            return $response;
        } catch (\Exception $e) {
            return response()->json(['error' => [
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ]], 500);
        }
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $input = $request->validated();
            $post->update($input);
            return response()->json([
                'message' => 'Data updated successfully',
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
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ]);
        }
    }
}
