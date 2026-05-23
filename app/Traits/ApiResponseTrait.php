<?php

namespace App\Traits;

trait ApiResponseTrait{
    protected function success($date = null, string $message = 'Success', int $code = 200)
    {
        return response()->json([
            'success'   => true,
            'message'   => $message,
            'data'      => $date
        ],$code);
    }

    protected function paginated($resource, string $message  = 'Success')
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $resource->items(),
            'meta' => [
                'current_page'  => $resource->currentPage(),
                'last_page'     => $resource->lastpage(),
                'per_page'      => $resource->perPage(),
                'total'         => $resource->total()
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
