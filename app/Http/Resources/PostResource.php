<?php

namespace App\Http\Resources;

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
            'author' => $this->whenLoaded('author')->only('id', 'name'),
            'tags' => $this->whenLoaded('tags')->makeHidden('pivot')->map->only('id', 'slug', 'title')
        ];
    }
}
