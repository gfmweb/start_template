<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name' => 'Администратор',
           'login' => 'admin',
           'password' => Hash::make('admin'),
        ]);
        RoleUser::create(
            ['role_id'=>1,'user_id'=>1]
        );
        RoleUser::create(
          ['role_id'=>2,'user_id'=>1]
        );
    }
}
