<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Matches;

class TeamsAndMatchesSeeder extends Seeder
{
    public function run(): void
    {
        // Crear equipos
        $teams = collect(['Dragons', 'Sharks', 'Tigers', 'Wolves'])
            ->map(fn($name) => Team::create(['name' => $name]));

        // Crear partidos sin resultado
        Matches::create([
            'home_team_id' => $teams[0]->id,
            'away_team_id' => $teams[1]->id
        ]);

        Matches::create([
            'home_team_id' => $teams[2]->id,
            'away_team_id' => $teams[3]->id
        ]);

        Matches::create([
            'home_team_id' => $teams[0]->id,
            'away_team_id' => $teams[2]->id
        ]);
    }
}