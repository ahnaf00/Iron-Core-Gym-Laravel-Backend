<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Services\BlogService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private BlogService $blogService){}

    public function index(Request $request):JsonResponse
    {
        $posts = $this->blogService->list($request->all());
        return $this->paginated(
            BlogResource::collection($posts)->resource,
            'Posts retrieved'
        );
    }

    public function store(StoreBlogRequest $request):JsonResponse
    {
        $post = $this->blogService->create($request->validated(), Auth::id());
        return $this->success(
            new BlogResource($post->load('author')),
            'Post created',
            201
        );
    }

    public function show(int $id):JsonResponse
    {
        $post = $this->blogService->find($id);
        return $this->success(new BlogResource($post), 'Post retrieved');
    }

    public function update(UpdateBlogRequest $request, int $id):JsonResponse
    {
        $post = $this->blogService->update($id, $request->validated());
        return $this->success(new BlogResource($post),'Post updated');
    }

    public function destroy(int $id):JsonResponse
    {
        $this->blogService->delete($id);
        return $this->success(null, 'Post deleted');
    }
}
