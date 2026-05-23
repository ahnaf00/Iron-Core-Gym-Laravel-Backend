<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'tags'          => 'array',
        'is_published'  => 'boolean',
        'published_at'  => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getThumbnailUrlattribute()
    {
        return $this->thumbnail ? Storage::url($this->thumbnail):null;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published',true);
    }
}
