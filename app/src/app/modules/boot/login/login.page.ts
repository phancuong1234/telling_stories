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
	public todo: FormGroup;

	constructor(
		private navCtrl: NavController,
		private loginService: LoginService,
		private formBuilder: FormBuilder,
		private router: Router
		){
		this.todo = this.formBuilder.group({
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

		this.loginService.login(this.todo.value).then(res => {
			if (res && res.code === 200) {
				this.router.navigate(['/app/home']);
			} else {
				alert('loi');
			}
		});
	}
}
