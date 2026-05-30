<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request):JsonResponse
    {
        if(!Auth::attempt($request->validated()))
        {
            return $this->error('Invalid credentials.',[],401);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        return $this->success([
            new UserResource($user),
            'Logged in successfully'
        ]);
    }

    public function logout(Request $request):JsonResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->success(null, 'Logged out successfully');
    }

    public function me():JsonResponse
    {
        return $this->success(
            new UserResource(Auth::user()),
            'user retrieved'
        );
    }
}
