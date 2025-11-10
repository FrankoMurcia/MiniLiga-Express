import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private baseUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) {}

  getMatches(): Observable<any> {
    return this.http.get(`${this.baseUrl}/matches`).pipe(
      catchError(() => {
        // Datos de prueba si el backend falla
        return of([
          {
            id: 1,
            home_team: 'Real Madrid',
            away_team: 'Barcelona',
            date: '2024-11-10T18:00:00',
            played: false
          },
          {
            id: 2,
            home_team: 'Manchester United',
            away_team: 'Liverpool',
            date: '2024-11-12T20:00:00',
            played: false
          }
        ]);
      })
    );
  }

  reportMatchResult(matchId: number, homeScore: number, awayScore: number): Observable<any> {
    return this.http.post(`${this.baseUrl}/matches/${matchId}/result`, {
      home_score: homeScore,
      away_score: awayScore
    }).pipe(
      catchError(error => {
        console.error('Error:', error);
        return of({ success: false });
      })
    );
  }
}