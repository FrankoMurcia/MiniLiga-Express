<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use App\Models\Team;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        return Matches::with('homeTeam', 'awayTeam')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id|different:home_team_id'
        ]);

        $match = Matches::create($request->all());
        return response()->json($match->load('homeTeam', 'awayTeam'), 201);
    }

    public function result(Request $request, $id)
    {
        $request->validate([
            'home_score' => 'required|integer|min:0',
            'away_score' => 'required|integer|min:0'
        ]);

        $match = Matches::findOrFail($id);

        if ($match->isPlayed()) {
            return response()->json([
                'error' => 'Este partido ya tiene resultado'
            ], 400);
        }

        // Actualizar resultado
        $match->update([
            'home_score' => $request->home_score,
            'away_score' => $request->away_score,
            'played_at' => now()
        ]);

        // Actualizar estadísticas de los equipos
        $homeTeam = $match->homeTeam;
        $awayTeam = $match->awayTeam;

        $homeTeam->goals_for += $request->home_score;
        $homeTeam->goals_against += $request->away_score;
        $homeTeam->save();

        $awayTeam->goals_for += $request->away_score;
        $awayTeam->goals_against += $request->home_score;
        $awayTeam->save();

        return response()->json($match->load('homeTeam', 'awayTeam'));
    }
}