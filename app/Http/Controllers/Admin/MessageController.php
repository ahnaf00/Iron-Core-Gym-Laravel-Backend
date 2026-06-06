<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactMessageResource;
use App\Services\ContactMessageService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private ContactMessageService $mesageService) {}

    public function index(Request $request):JsonResponse
    {
        $messsages = $this->mesageService->list($request->all());
        return $this->paginated(
            ContactMessageResource::collection($messsages)->resource,
            'Message retrieved'
        );
    }

    public function show(int $id):JsonResponse
    {
        $message = $this->mesageService->find($id);
        return $this->success(new ContactMessageResource($message),'Message retrieved');
    }

    public function markAsread(int $id):JsonResponse
    {
        $message = $this->mesageService->masAsRead($id);
        return $this->success(new ContactMessageResource($message), 'Marked as read');
    }

    public function markAsUnread(int $id):JsonResponse
    {
        $message = $this->mesageService->markAsUnread($id);
        return $this->success(new ContactMessageResource($message), 'Mark as unread');
    }

    public function destroy(int $id):JsonResponse
    {
        $this->mesageService->delete($id);
        return $this->success(null, 'Message deleted');
    }
}
