import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
{ path: '', redirectTo: 'boot/login', pathMatch: 'full' },
// { path: 'home', loadChildren: './modules/app/home/home.module#HomePageModule' },
// { path: 'classify', loadChildren: './modules/app/classify/classify.module#ClassifyPageModule' },
// { path: 'ranking', loadChildren: './modules/app/ranking/ranking.module#RankingPageModule' },
// { path: 'store', loadChildren: './modules/app/store/store.module#StorePageModule' },
// { path: 'mypage', loadChildren: './modules/app/mypage/mypage.module#MypagePageModule' },
{ path: 'boot', loadChildren: './modules/boot/boot.module#BootPageModule' },
{ path: 'app', loadChildren: './modules/app/app.module#AppPageModule' },

//{ path: 'login-complete', loadChildren: './modules/boot/login-complete/login-complete.module#LoginCompletePageModule' },
// { path: 'login', loadChildren: './modules/boot/login/login.module#LoginPageModule' },
// { path: 'register', loadChildren: './modules/boot/register/register.module#RegisterPageModule' },
// { path: 'splash', loadChildren: './modules/boot/splash/splash.module#SplashPageModule' },
];
@NgModule({
	imports: [
	RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
	],
	exports: [RouterModule]
})
export class AppRoutingModule {}
