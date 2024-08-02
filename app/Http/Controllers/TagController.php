<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        try {
            $tags = Tag::with(['posts.author'])->paginate(10);
            $response = TagResource::collection($tags)->additional([
                'message' => 'Get data successfully'
            ])->response()->setStatusCode(200);
            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function store(TagRequest $request)
    {
        try {
            $input = $request->validated();
            Tag::create($input);
            return response()->json([
                'message' => 'Tag added successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Tag $tag)
    {
        try {
            return (new TagResource(
                $tag->loadMissing('posts.author')
            ))->additional([
                'message' => 'Get data successfully'
            ])->response()->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function update(TagRequest $request, Tag $tag)
    {
        try {
            $input = $request->validated();
            $tag->update($input);
            return response()->json([
                'message' => 'Tag updated successfully'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return response()->json([
                'message' => 'Tag deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'serverMessage' => $e->getMessage()
            ], 500);
        }
    }
}
