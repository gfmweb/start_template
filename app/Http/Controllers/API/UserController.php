<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserContactsRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\UseCases\UserAction;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{
    public function updateContacts(UpdateUserContactsRequest $request)
    {
        try{
            UserAction::updateContacts($request->all(),$request->bearerToken());
            return response()->json(null,200,[],200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),422,[],256);
        }
    }

    public function changePassword(UserChangePasswordRequest $request):JsonResponse
    {
        try{
           UserAction::updateUserPassword($request->all(),$request->bearerToken());
           return response()->json(null,200,[],200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),422,[],256);
        }
    }



}
