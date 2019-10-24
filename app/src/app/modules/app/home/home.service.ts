import { Injectable } from '@angular/core';
import { HttpService } from './../../../core/services/http.service';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';
import { environment } from './../../../../environments/environment';





@Injectable({
	providedIn: 'root'
})
export class HomeService {

	constructor(
		private httpService: HttpService
		) { }
	/*async getListStoryNew(): Promise<any> {
		return this.httpService.send('GET', { url: 'http://telling_stories.test/api/story/new'}).then(res => {});
	}*/

	async getListStoryNew(): Promise<any> {
		
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/new',
		};
		return this.httpService.send('GET', config);
	}
}
