<?php

namespace Modules\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Authentication\Http\Requests\LoginRequest;
use Modules\Authentication\Traits\AuthenticationService;

class AuthenticationController extends Controller
{
    use AuthenticationService;

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function loginUser(LoginRequest $request): JsonResponse
    {
        $oauthUrl = config('app.url') . '/oauth/token';

        $login = $this->login($request, 'users', $oauthUrl);

        return $this->sendResponse($login->response, $login->status, ($login->status === 200));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logoutUser(Request $request): JsonResponse
    {
        $logout = $this->logout($request);

        return $this->sendResponse([ 'message' => $logout] );
    }
}
