<?php

namespace App\Services;

use App\Models\ClassSession;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ClassSessionService
{
    public function list(array $filters = []):LengthAwarePaginator
    {
        $query = ClassSession::with('trainer');

        if(!empty($filters['search']))
        {
            $query->where('name','like',"%{$filters['search']}%");
        }

        if(!empty($filters['day']))
        {
            $query->where('schedule_day',$filters['day']);
        }

        if(isset($filters['is_active']))
        {
            $query->where('is_active',$filters['is_active']);
        }

        return $query->latest()->paginate($filters['per_page'] ?? 15);
    }

    public function find(int $id):ClassSession
    {
        return ClassSession::with('trainer')->findOrFail($id);
    }

    public function create(array $data):ClassSession
    {
        $data['slug'] = Str::slug($data['name']);
        return ClassSession::create($data);
    }

    public function update(int $id, array $data):ClassSession
    {
        $class = ClassSession::findOrFail($id);
        if(isset($data['name']))
        {
            $data['slug'] = Str::slug($data['name']);
        }
        $class->update($data);
        return $class->fresh('trainer');
    }

    public function delete(int $id):void
    {
        ClassSession::findOrFail($id)->delete();
    }
}
