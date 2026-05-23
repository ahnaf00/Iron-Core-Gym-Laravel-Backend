<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipPlan extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'features'      => 'array',
        'is_popular'    => 'boolean',
        'is_active'     => 'boolean'
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
