<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  HasFactory;

    protected $fillable = [
        'name',
        'login',
        'password',
        'token',
        'rememberToken'
    ];

    public function email():HasOne
    {
        return $this->HasOne(Email::class);
    }

    public function phone():HasOne
    {
        return $this->HasOne(Phone::class);
    }

    public function telegram():HasOne
    {
        return $this->HasOne(Telegram::class);
    }

    public function roles():HasMany
    {
        return $this->HasMany(RoleUser::class);
    }

    public function firebase():HasOne
    {
        return $this->HasOne(FireBase::class);
    }



}
