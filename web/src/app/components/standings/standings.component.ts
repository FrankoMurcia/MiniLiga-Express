import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ApiService, Team } from '../../services/api.service';

@Component({
  selector: 'app-standings',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './standings.component.html',
  styleUrls: ['./standings.component.css']
})
export class StandingsComponent implements OnInit {
  standings: Team[] = [];
  loading = false;
  error = '';

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadStandings();
  }

  loadStandings() {
    this.loading = true;
    this.error = '';
    this.apiService.getStandings().subscribe({
      next: (data) => {
        this.standings = data;
        this.loading = false;
      },
      error: (err) => {
        this.error = 'Error al cargar la clasificación';
        this.loading = false;
        console.error(err);
      }
    });
  }

  getMedalEmoji(position: number): string {
    if (position === 0) return '🥇';
    if (position === 1) return '🥈';
    if (position === 2) return '🥉';
    return '';
  }
}