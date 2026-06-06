<?php

namespace App\Services;

use App\Models\ContactMessage;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;


class ContactMessageService
{
    public function list(array $filters = []):LengthAwarePaginator
    {
        $query = ContactMessage::query();

        if(!empty($filters['search']))
        {
            $search = $filters['search'];
            $query->where(function ($q) use ($search){
                $q->where('name','like',"%{$search}%")->orWhere('email','like',"%{$search}%")->orWhere('subject','like',"%{$search}%");
            });
        }

        if($filters['status'] ?? null === 'read')
        {
            $query->where('is_read',true);
        }
        elseif($filters['status'] ?? null === 'unread')
        {
            $query->where('is_read',false);
        }

        return $query->latest()->paginate($filters['per_page'] ?? 15);
    }

    public function find(int  $id):ContactMessage
    {
        return ContactMessage::findOrFail($id);
    }

    public function store(array $data):ContactMessage
    {
        return ContactMessage::create($data);
    }

    public function masAsRead(int $id):ContactMessage
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => false, 'read_at' => null]);
        return $message->fresh();
    }

    public function markAsUnread(int $id):ContactMessage
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => false, 'read_at' => null]);
        return $message->fresh();
    }

    public function delete(int $id):void
    {
        ContactMessage::findOrFail($id)->delete();
    }
}
