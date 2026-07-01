<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainerResource extends JsonResource
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
            'email'            => $this->email,
            'phone'            => $this->phone,
            'specialty'        => $this->specialty,
            'bio'              => $this->bio,
            'photo_url'        => $this->photo,
            'experience_years' => $this->experience_years,
            'is_active'        => $this->is_active,
            'classes_count'    => $this->whenCounted('classes'),
            'created_at'       => $this->created_at->toDateTimeString(),
        ];
    }
}
