<?php

namespace App\Http\Controllers\PublicApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Services\ContactMessageService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private ContactMessageService $messageService){}

    public function store(StoreContactMessageRequest $request):JsonResponse
    {
        $this->messageService->store($request->validated());
        return $this->success(null, 'Message sent successfully');
    }
}
