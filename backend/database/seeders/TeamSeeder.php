<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run()
    {
        Team::create(['name' => 'Real Madrid']);
        Team::create(['name' => 'Barcelona']);
        Team::create(['name' => 'Manchester United']);
        Team::create(['name' => 'Bayern Munich']);
    }
}