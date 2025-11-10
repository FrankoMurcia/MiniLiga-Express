import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'matches',
    pathMatch: 'full'
  },
  {
    path: 'matches',
    loadComponent: () => import('./pages/matches/matches.page').then(m => m.MatchesPage)
  },
  {
    path: 'match-result/:id',
    loadComponent: () => import('./pages/match-result/match-result.page').then(m => m.MatchResultPage)
  }
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }