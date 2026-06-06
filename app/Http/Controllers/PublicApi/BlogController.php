<?php
namespace App\Http\Controllers\PublicApi;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Services\BlogService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private BlogService $blogService){}

    public function index(Request $request):JsonResponse
    {
        $posts = $this->blogService->listPublished($request->all());
        return $this->paginated(
            BlogResource::collection($posts)->resource,
            'Posts retrieved'
        );
    }

    public function show(string $slug):JsonResponse
    {
        $post = $this->blogService->findBySlug($slug);
        return $this->success(new BlogResource($post), 'Post retrieved');
    }
}
