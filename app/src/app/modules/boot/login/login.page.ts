import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { FormGroup, FormBuilder } from '@angular/forms';
import { LoginService } from './login.service';
import { Router } from '@angular/router';

@Component({
	selector: 'app-login',
	templateUrl: './login.page.html',
	styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
	public formLogin: FormGroup;
	error_require: boolean;
	error_invalid: boolean;
	constructor(
		private navCtrl: NavController,
		private loginService: LoginService,
		private formBuilder: FormBuilder,
		private router: Router,
		){
		this.formLogin = this.formBuilder.group({
			email: [''],
			password: [''],
		});
	}

	ngOnInit() {
	}
	goToRegister() {
		this.navCtrl.navigateRoot('/boot/register');
	}
	login() {

		if(this.formLogin.value.email != '' && this.formLogin.value.password != ''){
			this.error_require = false;
			this.loginService.login(this.formLogin.value).then(res => {
				if (res && res.code === 200) {
					this.router.navigate(['/app/home']);
				} else {
					this.error_invalid = true;
				}
			});
		}else{
			this.error_invalid = false;
			this.error_require = true;
		}
	}
}
