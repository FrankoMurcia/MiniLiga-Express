import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { MatchResultPageRoutingModule } from './match-result-routing.module';

import { MatchResultPage } from './match-result.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    MatchResultPageRoutingModule
  ],
  declarations: [MatchResultPage]
})
export class MatchResultPageModule {}