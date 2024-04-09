<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PermissionCheck;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SimpleActionController extends Controller
{


    public function reception(Request $request,int $number = null):JsonResponse
    {
        $act = 'action_' . $number;
        return (method_exists($this,'action_'.$number))?

            $this->$act($request):
            response()->json('Нет такого маршрута',404,[],256);
    }

    public function action_1(Request $request): JsonResponse
    {
        try{
            return (PermissionCheck::checkPermission($request->bearerToken(),'Действие_1'))?
                 response()->json( 'Действие разрешено',  200,  [],  256):
                 response()->json('Действие запрещено',403,[],256);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 400,[],256);
        }
    }

    public function action_2(Request $request): JsonResponse
    {
        try{
            return (PermissionCheck::checkPermission($request->bearerToken(),'Действие_2'))?
                response()->json('Действие разрешено',200,[],256):
                response()->json('Действие запрещено',403,[],256);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 400,[],256);
        }
    }

    public function action_3(Request $request): JsonResponse
    {
        try{
            return (PermissionCheck::checkPermission($request->bearerToken(),'Действие_3'))?
                response()->json('Действие разрешено',200,[],256):
                response()->json('Действие запрещено',403,[],256);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 400,[],256);
        }
    }
}
