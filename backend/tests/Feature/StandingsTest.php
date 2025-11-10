<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Team;
use App\Models\Match;
use App\Models\Matches;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StandingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_standings_calculates_points_correctly()
    {
        // Arrange: Create teams
        $teamA = Team::create(['name' => 'Team A']);
        $teamB = Team::create(['name' => 'Team B']);
        $teamC = Team::create(['name' => 'Team C']);

        // Create matches
        // Team A wins 2-1 vs Team B
        Matches::create([
            'home_team_id' => $teamA->id,
            'away_team_id' => $teamB->id,
            'home_score' => 2,
            'away_score' => 1,
            'played_at' => now(),
            'date' => now()
        ]);

        // Team A draws 1-1 with Team C
        Matches::create([
            'home_team_id' => $teamA->id,
            'away_team_id' => $teamC->id,
            'home_score' => 1,
            'away_score' => 1,
            'played_at' => now(),
            'date' => now()
        ]);

        // Team C wins 2-0 vs Team B
        Matches::create([
            'home_team_id' => $teamB->id,
            'away_team_id' => $teamC->id,
            'home_score' => 0,
            'away_score' => 2,
            'played_at' => now(),
            'date' => now()
        ]);

        // Act: Get standings
        $response = $this->get('/api/standings');

        // Assert: Check status
        $response->assertStatus(200);
        
        // Assert: Check structure
        $response->assertJsonStructure([
            '*' => [
                'name',
                'played',
                'won',
                'drawn',
                'lost',
                'goals_for',
                'goals_against',
                'goal_diff',
                'points'
            ]
        ]);

        // Get standings data
        $standings = $response->json();
        
        // Assert: Verify data is not empty
        $this->assertNotEmpty($standings, 'Standings should not be empty');
        $this->assertCount(3, $standings, 'Should have 3 teams');

        // Assert: Team C should be FIRST with 4 points and +2 goal diff
        $this->assertEquals('Team C', $standings[0]['name']);
        $this->assertEquals(4, $standings[0]['points']);
        $this->assertEquals(2, $standings[0]['played']);
        $this->assertEquals(1, $standings[0]['won']);
        $this->assertEquals(1, $standings[0]['drawn']);
        $this->assertEquals(0, $standings[0]['lost']);
        $this->assertEquals(3, $standings[0]['goals_for']);
        $this->assertEquals(1, $standings[0]['goals_against']);
        $this->assertEquals(2, $standings[0]['goal_diff']);
        
        // Assert: Team A should be SECOND with 4 points but +1 goal diff
        $this->assertEquals('Team A', $standings[1]['name']);
        $this->assertEquals(4, $standings[1]['points']);
        $this->assertEquals(2, $standings[1]['played']);
        $this->assertEquals(1, $standings[1]['won']);
        $this->assertEquals(1, $standings[1]['drawn']);
        $this->assertEquals(0, $standings[1]['lost']);
        $this->assertEquals(3, $standings[1]['goals_for']);
        $this->assertEquals(2, $standings[1]['goals_against']);
        $this->assertEquals(1, $standings[1]['goal_diff']);
        
        // Assert: Team B should be LAST with 0 points
        $this->assertEquals('Team B', $standings[2]['name']);
        $this->assertEquals(0, $standings[2]['points']);
        $this->assertEquals(2, $standings[2]['played']);
        $this->assertEquals(0, $standings[2]['won']);
        $this->assertEquals(0, $standings[2]['drawn']);
        $this->assertEquals(2, $standings[2]['lost']);
        $this->assertEquals(1, $standings[2]['goals_for']);
        $this->assertEquals(4, $standings[2]['goals_against']);
        $this->assertEquals(-3, $standings[2]['goal_diff']);
    }
}