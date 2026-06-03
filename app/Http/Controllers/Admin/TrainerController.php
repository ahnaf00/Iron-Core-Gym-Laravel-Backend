<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainerRequest;
use App\Http\Requests\UpdateTrainerRequest;
use App\Http\Resources\TrainerResource;
use App\Services\TrainerService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private TrainerService $trainerService) {}

    public function index(Request $request):JsonResponse
    {
        $trainers = $this->trainerService->list($request->all());
        return $this->paginated(
            TrainerResource::collection($trainers)->resource,
            'Trainers retrieved'
        );
    }

    public function store(StoreTrainerRequest $request):JsonResponse
    {
        $trainer = $this->trainerService->create($request->validated());
        return $this->success(new TrainerResource($trainer),'trainer created');
    }

    public function  show(int $id):JsonResponse
    {
        $trainer = $this->trainerService->find($id);
        return $this->success(new TrainerResource($trainer), 'Trainer retrieved');
    }

    public function update(UpdateTrainerRequest $request, int $id):JsonResponse
    {
        $trainer = $this->trainerService->update($id,$request->validated());
        return $this->success(new TrainerResource($trainer),'Trainer updated');
    }

    public function destroy(int $id):JsonResponse
    {
        $this->trainerService->delete($id);
        return $this->success(null, 'Trainer deleted');
    }
}
