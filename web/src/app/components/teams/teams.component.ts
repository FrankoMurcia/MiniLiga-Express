import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService, Team } from '../../services/api.service';

@Component({
  selector: 'app-teams',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './teams.component.html',
  styleUrls: ['./teams.component.css']
})
export class TeamsComponent implements OnInit {
  teams: Team[] = [];
  newTeamName = '';
  loading = false;
  error = '';
  success = '';

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadTeams();
  }

  loadTeams() {
    this.loading = true;
    this.error = '';
    this.apiService.getTeams().subscribe({
      next: (data) => {
        this.teams = data;
        this.loading = false;
      },
      error: (err) => {
        this.error = 'Error al cargar equipos. Verifica que el backend esté corriendo.';
        this.loading = false;
        console.error(err);
      }
    });
  }

  addTeam() {
    if (!this.newTeamName.trim()) {
      this.error = 'El nombre del equipo no puede estar vacío';
      return;
    }
    
    this.loading = true;
    this.error = '';
    this.success = '';
    
    this.apiService.createTeam(this.newTeamName).subscribe({
      next: (team) => {
        this.teams.push(team);
        this.newTeamName = '';
        this.loading = false;
        this.success = `Equipo "${team.name}" creado exitosamente`;
        setTimeout(() => this.success = '', 3000);
      },
      error: (err) => {
        this.error = err.error?.message || 'Error al crear el equipo. Puede que ya exista.';
        this.loading = false;
        console.error(err);
      }
    });
  }
}