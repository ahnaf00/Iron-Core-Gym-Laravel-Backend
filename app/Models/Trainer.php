<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Trainer extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $cats = [
        'is_active' => 'boolean'
    ];

    public function classes()
    {
        return $this->hasmany(ClassSession::class);
    }

    public function getPgotoUrlAttribute()
    {
        return $this->photo ? Storage::url($this->photo):null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }
}
