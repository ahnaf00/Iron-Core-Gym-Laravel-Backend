<?php

namespace App\Services;

use App\Models\Trainer;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;


class TrainerService
{
    public function list(array $filters = []):LengthAwarePaginator
    {
        $query = Trainer::withCount('classes');

        if(!empty($filters['search']))
        {
            $search = $filters['search'];
            $query->where(function ($q) use ($search){
                $q->where('name','like', "%{$search}%")->orWhere('speciality','like',"%{$search}%");
            });
        }

        if(isset($filters['is_active']))
        {
            $query->where('is_active', $filters['is_active']);
        }

        return $query->latest()->paginate($filters['per_page'] ?? 15);
    }

    public function find(int $id):Trainer
    {
        return Trainer::withCount('classes')->findOrFail($id);
    }

    public function create(array $data):Trainer
    {
        if(isset($data['photo']))
        {
            $data['photo'] = $data['photo']->store('trainers','public');
        }

        return Trainer::create($data);
    }

    public function update(int $id, array $data):Trainer
    {
        $trainer = Trainer::findOrFail($id);

        if(isset($data['photo']))
        {
            if($trainer->photo)
            {
                Storage::disk('public')->delete($trainer->photo);
            }
            $data['photo'] = $data['photo']->store('trainers','public');
        }

        $trainer->update($data);
        return $trainer->fresh();
    }

    public function delete(int $id):void
    {
        $trainer = Trainer::findOrFail($id);
        if($trainer->photo)
        {
            Storage::disk('public')->delete($trainer->photo);
        }
        $trainer->delete();
    }
}
