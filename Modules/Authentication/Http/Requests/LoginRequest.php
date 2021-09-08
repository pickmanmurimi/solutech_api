<?php

namespace Modules\Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *  @OA\Schema(
 *      @OA\Property( property="email", type="string" ),
 *      @OA\Property( property="password", type="string" )
 * )
 *
 * Class LoginRequest
 * @package Modules\Authentication\Http\Requests
 */
class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required','email', 'exists:users,email'],
            'password' => ['required']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
