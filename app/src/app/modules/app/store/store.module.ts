import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { IonicModule } from '@ionic/angular';

import { StorePage } from './store.page';
import { HeaderPageModule, TabBarMenuPageModule } from '../../../shared/components';

const routes: Routes = [
{
  path: '',
  component: StorePage
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
  declarations: [StorePage]
})
export class StorePageModule {}
