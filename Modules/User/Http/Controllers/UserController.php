<?php

namespace Modules\User\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\User;
use Modules\User\Transformers\UserResource;

class UserController extends Controller
{
    /**
     * @return UserResource
     */
    public function me(): UserResource
    {
        /** @var User $user */
        $user = Auth::user();

        return new UserResource( $user );
    }
}
