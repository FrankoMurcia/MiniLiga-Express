<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Match;
use App\Models\Matches;

class MatchSeeder extends Seeder
{
    public function run()
    {
        $teams = Team::all();

        if ($teams->count() < 4) {
            $this->command->warn('Need at least 4 teams to create matches');
            return;
        }

        // Partidos pendientes
        Matches::create([
            'home_team_id' => $teams[0]->id,
            'away_team_id' => $teams[1]->id,
            'home_score' => 0,
            'away_score' => 0,
            'played_at' => null
        ]);

        Matches::create([
            'home_team_id' => $teams[2]->id,
            'away_team_id' => $teams[3]->id,
            'home_score' => 0,
            'away_score' => 0,
            'played_at' => null
        ]);

        Matches::create([
            'home_team_id' => $teams[0]->id,
            'away_team_id' => $teams[2]->id,
            'home_score' => 0,
            'away_score' => 0,
            'played_at' => null
        ]);

        // 1 partido ya jugado para probar standings
        Matches::create([
            'home_team_id' => $teams[1]->id,
            'away_team_id' => $teams[3]->id,
            'home_score' => 2,
            'away_score' => 1,
            'played_at' => now()->subDays(1)
        ]);
    }
}