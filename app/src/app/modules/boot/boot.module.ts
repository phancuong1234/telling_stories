import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { IonicModule } from '@ionic/angular';

import { BootPage } from './boot.page';

const routes: Routes = [
{
  path: '',
  component: BootPage,
  children: [
  //{ path: '', redirectTo: 'splash', pathMatch: 'full' },
   { path: 'login', loadChildren: './login/login.module#LoginPageModule' },
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
  declarations: [BootPage]
})
export class BootPageModule {}
