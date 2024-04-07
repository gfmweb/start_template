<?php

namespace App\Interfaces;

use App\DTO\UserDTO;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    public function getUserById(int $id): UserDTO;

    public function getUserByLogin(string $login): UserDTO;

    public function getUserByToken(string $token): UserDTO;

    public function getUserByRefreshToken(string $refreshToken): UserDTO;

    public function createUser(array $data): UserDTO;

    public function updateUser(UserDTO $user): UserDTO;

    public function deleteUser(int $id): void;

    public function getAllUsers(): array;

}
