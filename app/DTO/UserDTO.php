<?php

namespace App\DTO;

use App\DTO\DTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserDTO extends DTO
{

    public int $id;
    public string $name;
    public string $login;
    public string $password;
    public string|null $email;
    public int|null $telegram;
    public int|null $phone;
    public $roles;
    public string|null $token;
    public string|null $rememberToken;


    private function __construct(array $data, bool $readonly = false)
    {
        parent::__construct($readonly);
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->login = $data['login'];
        $this->password = $data['password'] ?? '';
        $this->email = $data['email'];
        $this->telegram = $data['telegram'];
        $this->phone = $data['phone'];
        $this->roles = $data['roles'];
        $this->token = $data['token'] ?? '';
        $this->rememberToken = $data['rememberToken'] ?? '';
    }

    public static function makeFromModel(User $user): UserDTO
    {
        return new self([
            'id' => $user->id,
            'name' => $user->name,
            'login' => $user->login,
            'password' => $user->password,
            'email' => $user->email->email ?? null,
            'phone' => $user->phone->phone ?? null,
            'telegram' => $user->telegram->telegram ?? null,
            'roles' => $user->roles ?? null,
            'token' => $user->token ?? null,
            'rememberToken' => $user->rememberToken ?? null,
        ]);
    }

    public static function makeFromCollection(Collection $users): array
    {
        $response = [];
        foreach ($users as $user) {
            $response[] = self::toArray(new self([
                'id' => $user->id,
                'name' => $user->name,
                'login' => $user->login,
                'password' => $user->password,
                'email' => $user->email->email ?? null,
                'phone' => $user->phone->phone ?? null,
                'telegram' => $user->telegram->telegram ?? null,
                'roles' => $user->roles ?? null,
                'token' => $user->token ?? null,
                'rememberToken' => $user->rememberToken ?? null,
            ]));
        }
        $pages = count($response) / 5;
        $res = [];
        for ($i = 0; $i <= $pages; $i++) {
            $res[] = array_slice($response, $i * 5, 5);
        }
        $pagesIndexes = [];
        for ($i = 0; $i < ceil($pages); $i++) {
            $pagesIndexes[] = $i;
        }
        return ['data' => $res, 'pages' => $pagesIndexes];
    }

    public static function makeFromArray(array $data): UserDTO
    {
        return new self($data);
    }

    public static function toArray(UserDTO $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'login' => $user->login,
            'phone' => $user->phone,
            'email' => $user->email,
            'telegram' => $user->telegram,
            'roles' => $user->roles,
            'token' => $user->token,
            'refreshToken' => $user->rememberToken
        ];
    }

    public static function toJson(UserDTO $user): string
    {
        return json_encode([
            'id' => $user->id,
            'name' => $user->name,
            'login' => $user->login,
            'phone' => $user->phone,
            'email' => $user->email,
            'telegram' => $user->telegram,
            'roles' => $user->roles,
            'token' => $user->token,
            'refreshToken' => $user->rememberToken
        ], 256);
    }

    public static function toObject(UserDTO $user): object
    {
        return (object)[
            'id' => $user->id,
            'name' => $user->name,
            'login' => $user->login,
            'phone' => $user->phone,
            'email' => $user->email,
            'telegram' => $user->telegram,
            'roles' => $user->roles,
            'token' => $user->token,
            'refreshToken' => $user->rememberToken
        ];
    }
}
