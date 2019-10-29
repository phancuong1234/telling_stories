import { Injectable } from '@angular/core';
import { HttpService } from './../../../core/services/http.service';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';
import { environment } from './../../../../environments/environment';

@Injectable({
	providedIn: 'root'
})
export class LoginService {

	constructor(
		private httpService: HttpService
		) { }
	// login(body: any): Promise<any> {
		// 	return this.httpService.send('POST', { url: 'http://telling_stories.test/api/user/login', body }).then(res => {});
		// }
		async login(body: any): Promise<any> {
			
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/user/login',
				body
			};
			return this.httpService.send('POST', config);
		}
	}
