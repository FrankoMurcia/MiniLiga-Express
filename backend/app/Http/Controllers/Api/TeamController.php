<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return Team::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:teams,name|max:255'
        ]);

        $team = Team::create([
            'name' => $request->name
        ]);

        return response()->json($team, 201);
    }
}