import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { FormGroup } from '@angular/forms';

@Component({
	selector: 'app-login',
	templateUrl: './login.page.html',
	styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
	public onLoginForm: FormGroup;

	constructor(
		private navCtrl: NavController,
		){}

	ngOnInit() {
	}
	goToRegister() {
		this.navCtrl.navigateRoot('/boot/register');
	}
	login() {
		this.navCtrl.navigateForward('/app/home');
		// this.loginService.login(this.formLogin.value).then(res => {
			// 	if (res && res.code === 200) {
				// 		this.router.navigate(['/'], {
					// 			queryParams: {
						// 				episode_translate_id: this.formLogin.value.episode_translate_id,
						// 				novel_translate_id: this.formLogin.value.novel_translate_id
						// 			}
						// 		});
						// 	} else {
							// 		alert(res.error);
							// 	}
							// });
						}
  /*goToHome() {
    this.navCtrl.navigateRoot('/home-results');
}*/
}
