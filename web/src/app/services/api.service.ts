import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Team {
  id?: number;
  name: string;
  points?: number;
  played?: number;
  won?: number;
  drawn?: number;
  lost?: number;
  goals_for?: number;
  goals_against?: number;
  goal_diff?: number;
}

export interface Match {
  id?: number;
  home_team_id: number;
  away_team_id: number;
  home_score?: number;
  away_score?: number;
  played_at: boolean;
  match_date: string;
  homeTeam?: Team;
  awayTeam?: Team;
}

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private apiUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) { }

  getTeams(): Observable<Team[]> {
    return this.http.get<Team[]>(`${this.apiUrl}/teams`);
  }

  createTeam(name: string): Observable<Team> {
    return this.http.post<Team>(`${this.apiUrl}/teams`, { name });
  }

  getStandings(): Observable<Team[]> {
    return this.http.get<Team[]>(`${this.apiUrl}/standings`);
  }

  getMatches(): Observable<Match[]> {
    return this.http.get<Match[]>(`${this.apiUrl}/matches`);
  }

  updateMatchResult(matchId: number, homeScore: number, awayScore: number): Observable<Match> {
    return this.http.post<Match>(`${this.apiUrl}/matches/${matchId}/result`, {
      home_score: homeScore,
      away_score: awayScore
    });
  }
}