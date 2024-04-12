<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepository;
use App\Models\User;
use App\Services\FireBase;
use App\UseCases\UserAction;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TScontroller extends Controller
{

    public function index(Request $request, UserRepository $repository):JsonResponse
    {

        try {
            $userRep = app(UserRepository::class);
            $user = $userRep->getUserByToken($request->bearerToken());
            FireBase::sendPush(
                $user->firebase,
                'Текущее время сервера ' . Carbon::now()->format('H:i:s'), 'Тестовое сообщение'
            );
            return response()->json(null, 204, [], 256);
        }catch (\Exception $exception){
            return response()->json('Не отправлено', 422, [], 256);
        }
    }

    public function APIaction(Request $request):JsonResponse
    {
        return response()->json([$request->all(),$request->bearerToken()], 200);
    }
}
