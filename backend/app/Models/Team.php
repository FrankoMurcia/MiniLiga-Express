<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'goals_for',
        'goals_against'
    ];

    protected $appends = ['points', 'played', 'won', 'drawn', 'lost', 'goal_diff'];

    public function homeMatches()
    {
        return $this->hasMany(Matches::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Matches::class, 'away_team_id');
    }

    public function matches()
    {
        return $this->homeMatches->merge($this->awayMatches);
    }

    // Atributos calculados
    public function getPlayedAttribute()
    {
        return $this->homeMatches()->whereNotNull('home_score')->count() +
               $this->awayMatches()->whereNotNull('away_score')->count();
    }

    public function getWonAttribute()
    {
        $homeWins = $this->homeMatches()
            ->whereNotNull('home_score')
            ->whereRaw('home_score > away_score')
            ->count();
        
        $awayWins = $this->awayMatches()
            ->whereNotNull('away_score')
            ->whereRaw('away_score > home_score')
            ->count();
        
        return $homeWins + $awayWins;
    }

    public function getDrawnAttribute()
    {
        $homeDraws = $this->homeMatches()
            ->whereNotNull('home_score')
            ->whereRaw('home_score = away_score')
            ->count();
        
        $awayDraws = $this->awayMatches()
            ->whereNotNull('away_score')
            ->whereRaw('away_score = home_score')
            ->count();
        
        return $homeDraws + $awayDraws;
    }

    public function getLostAttribute()
    {
        return $this->played - $this->won - $this->drawn;
    }

    public function getGoalDiffAttribute()
    {
        return $this->goals_for - $this->goals_against;
    }

    public function getPointsAttribute()
    {
        return ($this->won * 3) + $this->drawn;
    }
}