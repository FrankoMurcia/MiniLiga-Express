import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService, Match } from '../../services/api.service';

@Component({
  selector: 'app-matches',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './matches.component.html',
  styleUrl: './matches.component.css'
})
export class MatchesComponent implements OnInit {
  matches: Match[] = [];
  loading: boolean = false;
  error: string = '';
  selectedMatch: Match | null = null;
  homeScore: number = 0;
  awayScore: number = 0;

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadMatches();
  }

  loadMatches() {
    this.loading = true;
    this.apiService.getMatches().subscribe({
      next: (data) => {
        this.matches = data;
        this.loading = false;
      },
      error: (err) => {
        this.error = 'Error al cargar partidos';
        this.loading = false;
        console.error(err);
      }
    });
  }

  openModal(match: Match) {
    if (match.played_at) {
      this.error = 'Este partido ya fue jugado';
      return;
    }
    this.selectedMatch = match;
    this.homeScore = 0;
    this.awayScore = 0;
    this.error = '';
  }

  closeModal() {
    this.selectedMatch = null;
    this.homeScore = 0;
    this.awayScore = 0;
    this.error = '';
  }

  submitResult() {
    if (!this.selectedMatch) return;

    this.loading = true;
    this.apiService.updateMatchResult(
      this.selectedMatch.id!,
      this.homeScore,
      this.awayScore
    ).subscribe({
      next: (updatedMatch) => {
        // Actualizar el partido en la lista
        const index = this.matches.findIndex(m => m.id === updatedMatch.id);
        if (index !== -1) {
          this.matches[index] = updatedMatch;
        }
        this.closeModal();
        this.loading = false;
      },
      error: (err) => {
        this.error = 'Error al actualizar resultado';
        this.loading = false;
        console.error(err);
      }
    });
  }

  formatDate(dateString: string): string {
    const date = new Date(dateString);
    return date.toLocaleDateString('es-ES', { 
      year: 'numeric', 
      month: 'long', 
      day: 'numeric' 
    });
  }

  get upcomingMatches() {
    return this.matches.filter(m => !m.played_at);
  }

  get playedMatches() {
    return this.matches.filter(m => m.played_at);
  }
}