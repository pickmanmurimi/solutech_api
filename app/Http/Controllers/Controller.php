<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * sendResponse
     *
     * @param $response
     * @param int $code
     * @param bool $success
     * @return JsonResponse
     */
    public function sendResponse( $response, int $code = 200, bool $success = true): JsonResponse
    {

        return response()->json( array_merge( (array) $response,['success' => $success]), $code );

    }

    /**
     * sendError
     *
     * @param  $error
     * @param int $code
     * @return JsonResponse
     */
    public function sendError( $error, int $code = 404): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $error
        ], $code);
    }

    /**
     * sendSuccess
     *
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendSuccess( $message, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], $code);
    }
}
