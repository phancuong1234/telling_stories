import { Injectable } from '@angular/core';
import { HttpService } from './../../../core/services/http.service';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';

@Injectable({
	providedIn: 'root'
})
export class MypageService {

	constructor(
		private httpService: HttpService
		) { }
	async logout(token: any): Promise<any> {
		
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/logout',
			headers: token
		};
		return this.httpService.send('post', config);
	}
}
