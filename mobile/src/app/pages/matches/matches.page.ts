import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-matches',
  templateUrl: './matches.page.html',
  styleUrls: ['./matches.page.scss'],
  standalone: true,
  imports: [CommonModule, IonicModule]
})
export class MatchesPage implements OnInit {
  matches: any[] = [];
  loading = true;

  constructor(
    private api: ApiService,
    private router: Router
  ) {}

  ngOnInit() {
    this.loadMatches();
  }

  loadMatches() {
    this.loading = true;
    this.api.getMatches().subscribe(data => {
      this.matches = data.filter((m: any) => !m.played);
      this.loading = false;
    });
  }

  goToResult(matchId: number) {
    this.router.navigate(['/match-result', matchId]);
  }
}