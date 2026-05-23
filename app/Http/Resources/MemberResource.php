<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status,
            'photo_url' => $this->photo_url,
            'join_date' => $this->join_date->format('Y-m-d'),
            'membership_plan' => new MembershipPlanResource($this->whenLoaded('membershipPlan')),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
