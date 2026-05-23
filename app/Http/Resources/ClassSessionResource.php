<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'slug'             => $this->slug,
            'description'      => $this->description,
            'category'         => $this->category,
            'schedule_day'     => $this->schedule_day,
            'schedule_time'    => $this->schedule_time,
            'duration_minutes' => $this->duration_minutes,
            'capacity'         => $this->capacity,
            'is_active'        => $this->is_active,
            'trainer'          => new TrainerResource($this->whenLoaded('trainer')),
            'created_at'       => $this->created_at->toDateTimeString(),
        ];
    }
}
