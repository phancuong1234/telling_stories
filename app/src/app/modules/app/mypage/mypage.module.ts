import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { IonicModule } from '@ionic/angular';

import { MypagePage } from './mypage.page';
import { HeaderPageModule, TabBarMenuPageModule } from '../../../shared/components';

const routes: Routes = [
{
  path: '',
  component: MypagePage
}
];

@NgModule({
  imports: [
  CommonModule,
  FormsModule,
  IonicModule,
  HeaderPageModule,
  TabBarMenuPageModule,
  RouterModule.forChild(routes)
  ],
  declarations: [MypagePage]
})
export class MypagePageModule {}
