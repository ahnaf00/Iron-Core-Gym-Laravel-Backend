<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSession extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
