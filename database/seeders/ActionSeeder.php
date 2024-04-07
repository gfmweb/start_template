<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = ['Действие_1','Действие_2','Действие_3'];
        foreach ($actions as $action) {
            Action::create([
               'action' => $action,
            ]);
        }
    }
}
