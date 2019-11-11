import { Injectable } from '@angular/core';
import { HttpClient  } from '@angular/common/http';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';
import { NavController } from '@ionic/angular';
import { Router } from '@angular/router';

@Injectable({
	providedIn: 'root'
})
export class LoginService {

	constructor(
		private http: HttpClient,
		private navCtrl: NavController,
		private router: Router
		) { }

	async login(body: any): Promise<any> {
		const httpOptions = {
			body: body
		}; 
		return this.http
		.request<any>('post', 'http://telling_stories.test/api/user/login', {
			body: body,

		})
		.toPromise()
		.then(res => this.httpSucess(res))
		.catch(error => this.httpError(error));
	}

	private httpSucess(res: Response): Promise<any> {
		const body: any = res || { message: 'Request success' };
		if (body && body.code && body.code === 200 && body.token) {
			localStorage.setItem('token',body.token);
			return Promise.resolve(body);
		} else {
			if (body.code === 401) {
				this.router.navigate(['/boot/login']);
				return;
			}
			return Promise.resolve(body);
		}
	}


	private httpError(error: any) {
		console.log(error);
		// alert('Request error');
		//throw new Error(error);
	}
}
