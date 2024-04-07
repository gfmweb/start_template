<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    protected $redis;
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $this->redis = Redis::connection();
    }
}
