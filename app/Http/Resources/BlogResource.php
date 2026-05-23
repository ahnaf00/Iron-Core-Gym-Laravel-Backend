<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'slug'          => $this->slug,
            'content'       => $this->when($request->routeIs('*.show'), $this->content),
            'excerpt'       => $this->excerpt,
            'thumbnail_url' => $this->thumbnail_url,
            'category'      => $this->category,
            'tags'          => $this->tags,
            'is_published'  => $this->is_published,
            'published_at'  => $this->published_at?->toDateTimeString(),
            'author'        => new UserResource($this->whenLoaded('author')),
            'created_at'    => $this->created_at->toDateTimeString(),
        ];
    }
}
