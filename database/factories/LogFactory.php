<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'user_id' => 1,
           'data' => json_encode(['action'=>'Some Action','payload'=>'Some Payload']),
           'created_at' => Carbon::now()->addDays(rand(-1,-7))

        ];
    }
}
