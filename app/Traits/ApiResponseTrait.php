<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponseTrait{
    protected function success($data = null, string $message = 'Success', int $code = 200)
    {
        return response()->json([
            'success'   => true,
            'message'   => $message,
            'data'      => $data
        ],$code);
    }

    protected function paginated($resource, string $message  = 'Success')
    {
        $paginator = $resource instanceof ResourceCollection ? $resource->resource : $resource;

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $paginator->items(),
            'meta' => [
                'current_page'  => $paginator->currentPage(),
                'last_page'     => $paginator->lastpage(),
                'per_page'      => $paginator->perPage(),
                'total'         => $paginator->total()
            ],
        ]);
    }

    protected function error(string $message = 'Error', array $errors = [],int $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
       ], $code);
    }
}
