import { Injectable } from '@angular/core';
import { HttpClient  } from '@angular/common/http';
import { HttpService } from './../../../core/services/http.service';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';

@Injectable({
	providedIn: 'root'
})
export class LoginService {

	constructor(
		private httpService: HttpService
		) { }

	async login(body: any): Promise<any> {

		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/user/login',
			body
		};
		return this.httpService.send('POST', config);
	}
}
