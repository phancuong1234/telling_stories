import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { IonicModule } from '@ionic/angular';

import { AppPage } from './app.page';

const routes: Routes = [
{
  path: '',
  component: AppPage,
  children: [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  {
    path: 'story',
    children: [
    { path: ':id/detail', loadChildren: './story/detail/detail.module#DetailPageModule' },

    ]},
    {
      path: 'home', loadChildren: './home/home.module#HomePageModule',
    },
    {
      path: 'classify', loadChildren: './classify/classify.module#ClassifyPageModule'
    },
    {
      path: 'store', loadChildren: './store/store.module#StorePageModule'
    },
    {
      path: 'mypage', loadChildren: './mypage/mypage.module#MypagePageModule'
    },
    {
      path: 'ranking', loadChildren: './ranking/ranking.module#RankingPageModule'
    },
    ]
  }
  ];

  @NgModule({
    imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RouterModule.forChild(routes)
    ],
    declarations: [AppPage]
  })
  export class AppPageModule {}
