<?php


namespace Modules\Authentication\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Class AuthenticationService
 * @package Modules\Authentication\Services
 */
trait AuthenticationService
{
    /**
     * authFail
     * @var array $authFail
     */
    public array $authFail = [
        'message' => 'Wrong Email and Password combination',
        'errors' => [
            'email' => ['Wrong Email and Password combination'],
            'password' => ['Wrong Email and Password combination'],]];

    /**
     * $serverError
     * @var array $serverError
     */
    public array $serverError = [
        'message' => 'Whoops Something went wrong during authentication.',
        'errors' => [
            'email' => ['Something went wrong'],
            'password' => ['Something went wrong'],]];

    /**
     * @param $request
     * @param string $provider
     * @param string $oauthUrl
     * @return object
     */
    public function login($request, string $provider = 'users', string $oauthUrl = '/oauth/token'): object
    {
        try {

            $client_id = config('passport.oauth_clients.' . $provider . '.client_id');
            $client_secret = config('passport.oauth_clients.' . $provider . '.client_secret');

            $response = Http::post($oauthUrl,  [
                'grant_type' => 'password',
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'username' => $request->email,
                'password' => $request->password,
            ] );

            switch ($response->status()) {
                case 500:
                case 401:
                    return (object)['response' => $this->serverError, 'status' => 500];
                    break;
                case 200:
                    /**
                     * If is successful
                     */
                    return (object)[
                        'response' => array_merge((array)json_decode($response->body()),
                            ['message' => 'Success Login']),
                        'status' => $response->status()];
                    break;
                default:
                    return (object)['response' => $this->authFail, 'status' => 422];

            }

        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return (object)['response' => $this->serverError, 'status' => 500];
        }

    }

    /**
     * logout
     *
     * @param Request $request
     * @return string
     */
    public function logout(Request $request): string
    {
        $tokens = $request->user()->tokens;

        foreach ($tokens as $token) {
            $token->revoke();
        }

        return 'You are logged out';
    }


}
