<?php

namespace App\Http\Controllers\API;

use App\DTO\UserDTO;
use App\Exceptions\LoginRegisterLogoutException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\UseCases\LoginRegisterLogout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            return response()->json(
                UserDTO::toArray(LoginRegisterLogout::login($request->all()))
                , 200, [], 256);
        } catch (LoginRegisterLogoutException $e) {
            return response()->json($e->getMessage(), 422, [], 256);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            return response()->json(
                UserDTO::toArray(
                    LoginRegisterLogout::register($request->all(), $request->getClientIp())
                )
                , 201, [], 256
            );
        } catch (LoginRegisterLogoutException $e) {
            return response()->json($e->getMessage(), 422, [], 256);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        LoginRegisterLogout::logout($request->bearerToken());
        return response()->json(null, 204, []);
    }

    public function changePassword(ChangePasswordRequest $request)
    {

    }
}
