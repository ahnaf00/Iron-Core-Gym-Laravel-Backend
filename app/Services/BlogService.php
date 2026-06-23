<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogService
{
    public function list(array $filters = []):LengthAwarePaginator
    {
        $query = Blog::with('author');

        if(!empty($filters['search']))
        {
            $search = $filters['search'];
            $query->where(function ($q) use ($search){
                $q->where('title','like',"%{$search}%")->orWhere('category','like',"%{$search}%");
            });
        }

        if(!empty($filters['category']))
        {
            $query->where('category',$filters['category']);
        }

        if(isset($filters['is_published']))
        {
            $query->where('is_published',$filters['is_published']);
        }

        return $query->latest()->paginate($filters['per_page'] ?? 15);
    }

    public function listPublished(array $filters = []):LengthAwarePaginator
    {
        $query = Blog::published()->with('author');

        if(!empty($filters['category']))
        {
            $query->where('category',$filters['category']);
        }

        return $query->latest('published_at')->paginate($filters['per_page'] ?? 15);
    }

    public function findBySlug(string $slug):BLog
    {
        return Blog::published()->with('author')->where('slug',$slug)->firstOrFail();
    }

    public function find(int $id):Blog
    {
        return Blog::with('author')->findOrFail($id);
    }

    public function create(array $data, int $authorId):Blog
    {
        $data['author_id'] = $authorId;
        $data['slug'] = Str::slug($data['title']);

        if(isset($data['thumbnail']))
        {
            $data['thumbnail'] = $data['thumbnail']->store('blogs','public');
        }

        if(!empty($data['is_published']))
        {
            $data['published_at'] = Carbon::now();
        }

        return Blog::create($data);
    }

    public function update(int $id, array $data):Blog
    {
        $blog = Blog::findOrFail($id);

        if(isset($data['title']))
        {
            $data['slug'] = Str::slug($data['title']);
        }

        if(isset($data['thumbnail']))
        {
            if($blog->thumbnail)
            {
                Storage::disk('public')->delete($blog->thumbnail);
            }
            $data['thumbnail'] = $data['thumbnail']->store('blogs','public');
        }

        // handle publishing
        if(isset($data['is_published']) && $data['is_published'] && !$blog->is_published)
        {
            $data['published_at'] = Carbon::now();
        }
        elseif(isset($data['is_published']) && !$data['is_published'])
        {
            $data['published_at'] = null;
        }

        $blog->update($data);
        return $blog->fresh('author');
    }

    public function delete(int $id):void
    {
        $blog = Blog::findOrFail($id);
        if($blog->thumbnail)
        {
            Storage::disk('public')->delete($blog->thumbnail);
        }
        $blog->delete();
    }
}
