<?php

namespace App\Http\Resources;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        JsonResource::withoutWrapping();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image,
            'published' => $this->published ? true : false,
            'created_at' =>  $this->created_at->diffForHumans(),
            'updated_at' =>  $this->updated_at->diffForHumans(),
            'author' => new UserResource($this->whenLoaded('author')),
            // 'tags' => $this->whenLoaded('tags', function ($tag) {
            //     return $this->setTagCustomAttribute($tag);
            // })
            'tags' => TagResource::collection($this->whenLoaded('tags'))
        ];
    }

    protected function setTagCustomAttribute($tag)
    {
        $values = $tag->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug
            ];
        });
        return $values;
    }
}
