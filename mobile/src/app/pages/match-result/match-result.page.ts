import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule, AlertController, LoadingController } from '@ionic/angular';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-match-result',
  templateUrl: './match-result.page.html',
  styleUrls: ['./match-result.page.scss'],
  standalone: true,
  imports: [CommonModule, FormsModule, IonicModule]
})
export class MatchResultPage implements OnInit {
  matchId: number = 0;
  homeScore: number = 0;
  awayScore: number = 0;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private api: ApiService,
    private alertCtrl: AlertController,
    private loadingCtrl: LoadingController
  ) {}

  ngOnInit() {
    this.matchId = Number(this.route.snapshot.paramMap.get('id'));
  }

  async submitResult() {
    const loading = await this.loadingCtrl.create({
      message: 'Guardando...'
    });
    await loading.present();

    this.api.reportMatchResult(this.matchId, this.homeScore, this.awayScore).subscribe(
      async () => {
        await loading.dismiss();
        const alert = await this.alertCtrl.create({
          header: '✅ Éxito',
          message: 'Resultado guardado correctamente',
          buttons: ['OK']
        });
        await alert.present();
        this.router.navigate(['/matches']);
      },
      async () => {
        await loading.dismiss();
        const alert = await this.alertCtrl.create({
          header: '❌ Error',
          message: 'No se pudo guardar el resultado',
          buttons: ['OK']
        });
        await alert.present();
      }
    );
  }
}