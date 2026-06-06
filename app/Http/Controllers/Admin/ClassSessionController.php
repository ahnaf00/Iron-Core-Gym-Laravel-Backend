<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassSessionRequest;
use App\Http\Requests\UpdateClassSessionRequest;
use App\Http\Resources\ClassSessionResource;
use App\Services\ClassSessionService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ClassSessionController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private ClassSessionService $classSessionService){}

    public function index(Request $request):JsonResponse
    {
        $classes = $this->classSessionService->list($request->all());
        return $this->paginated(
            ClassSessionResource::collection($classes)->resource,
            'Classes retrieved'
        );
    }

    public function store(StoreClassSessionRequest $request):JsonResponse
    {
        $class = $this->classSessionService->create($request->validated());
        return $this->success(
            new ClassSessionResource($class->load('trainer')),
            'Class Created',
            201
        );
    }

    public function show(int $id):JsonResponse
    {
        $class = $this->classSessionService->find($id);
        return $this->success(new ClassSessionResource($class),
            'Class retrieved'
        );
    }

    public function update(UpdateClassSessionRequest $request, int $id):JsonResponse
    {
        $class = $this->classSessionService->update($id, $request->validated());
        return $this->success(new ClassSessionResource($class), 'Class updated');
    }

    public function destroy(int $id):JsonResponse
    {
        $this->classSessionService->delete($id);
        return $this->success(null, 'Class deleted');
    }
}
