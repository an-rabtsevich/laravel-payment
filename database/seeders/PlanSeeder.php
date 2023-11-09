<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'slug' => 'monthly',
            'price' => 1200,
            'duration_in_days' => 30,
        ]);
        Plan::create([
            'slug' => 'yearly',
            'price' => 9999,
            'duration_in_days' => 365,
        ]);
    }
}
