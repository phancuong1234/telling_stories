import { Injectable, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpParams, HttpHeaders  } from '@angular/common/http';
import { HttpRequestOpts } from '../../core/services/http-request-opts';
import { NavController } from '@ionic/angular';

@Injectable()
export class HttpService {
	constructor(
		private http: HttpClient,
		private navCtrl: NavController,
		private router: Router,
		) { }

	send(method: string, config: HttpRequestOpts): Promise<any> {
		let params = new HttpParams();

		if (config.params) {
			for (const key of Object.keys(config.params)) {
				params = params.append(key, config.params[key]);
			}
		}
		return this.http
		.request<any>(method.toUpperCase(), config.url, {
			body: config.body,
			params,
			headers: new HttpHeaders({
				'token': config.headers
			})

		})
		.toPromise()
		.then(res => this.httpSucess(res))
		.catch(error => this.httpError(error));
	}

	private httpSucess(res: Response): Promise<any> {
		const body: any = res || { message: 'Request success' };
		if (body && body.code && body.code === 200) {
			return Promise.resolve(body);
		} else {
			if (body.code === 401) {
				this.router.navigate(['/boot/login']);
				localStorage.clear();
				return ;
			}
			return Promise.resolve(body);
		}
	}


	private httpError(error: any) {
		this.router.navigate(['/boot/login']);

		console.log('eror');
		//throw new Error(error);
	}
}
