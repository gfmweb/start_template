<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PermissionCheck;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LkController extends Controller
{
    public function index(Request $request):JsonResponse
    {
        if(!PermissionCheck::checkPermission($request->bearerToken(),'Действие_1'))
        return response()->json('Не достаточно прав',403,[],256);
        return response()->json('Всё в порядке',200,[],256);
    }
}
