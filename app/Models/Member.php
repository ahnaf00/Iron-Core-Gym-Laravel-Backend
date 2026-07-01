<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    use SoftDeletes,HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'join_date' => 'date'
    ];

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? Storage::url($this->photo):null;
    }

    public function scopeActive($query)
    {
        return $query->where('status','active');
    }
}
