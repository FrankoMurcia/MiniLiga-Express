<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Match;
use App\Models\Matches;

class StandingsController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $standings = [];

        foreach ($teams as $team) {
            // Inicializar estadísticas
            $played = 0;
            $won = 0;
            $drawn = 0;
            $lost = 0;
            $goalsFor = 0;
            $goalsAgainst = 0;

            // Partidos como local (CAMBIADO: played_at en lugar de played)
            $homeMatches = Matches::where('home_team_id', $team->id)
                ->whereNotNull('played_at')  // ← CAMBIO AQUÍ
                ->get();
            
            foreach ($homeMatches as $match) {
                $played++;
                $goalsFor += $match->home_score ?? 0;
                $goalsAgainst += $match->away_score ?? 0;

                if ($match->home_score > $match->away_score) {
                    $won++;
                } elseif ($match->home_score == $match->away_score) {
                    $drawn++;
                } else {
                    $lost++;
                }
            }

            // Partidos como visitante (CAMBIADO: played_at en lugar de played)
            $awayMatches = Matches::where('away_team_id', $team->id)
                ->whereNotNull('played_at')  // ← CAMBIO AQUÍ
                ->get();
            
            foreach ($awayMatches as $match) {
                $played++;
                $goalsFor += $match->away_score ?? 0;
                $goalsAgainst += $match->home_score ?? 0;

                if ($match->away_score > $match->home_score) {
                    $won++;
                } elseif ($match->away_score == $match->home_score) {
                    $drawn++;
                } else {
                    $lost++;
                }
            }

            $standings[] = [
                'id' => $team->id,
                'name' => $team->name,
                'played' => $played,
                'won' => $won,
                'drawn' => $drawn,
                'lost' => $lost,
                'goals_for' => $goalsFor,
                'goals_against' => $goalsAgainst,
                'goal_diff' => $goalsFor - $goalsAgainst,
                'points' => ($won * 3) + $drawn
            ];
        }

        // Ordenar correctamente
        usort($standings, function($a, $b) {
            if ($a['points'] != $b['points']) {
                return $b['points'] - $a['points'];
            }
            if ($a['goal_diff'] != $b['goal_diff']) {
                return $b['goal_diff'] - $a['goal_diff'];
            }
            return $b['goals_for'] - $a['goals_for'];
        });

        return response()->json($standings);
    }
}