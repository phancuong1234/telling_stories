import { Injectable } from '@angular/core';
import { HttpService } from './../../../core/services/http.service';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';

@Injectable({
	providedIn: 'root'
})
export class StoreService {

	constructor(
		private httpService: HttpService
		) { }

	async getListStoryStore(type: number, offset: number): Promise<any> {
		if(type === 1){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/history?id=1',
			};
			return this.httpService.send('GET', config);
		} else if(type === 2){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/favorite?id=1',
			};
			return this.httpService.send('GET', config);
		} else if(type === 3){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/download?id=1',
			};
			return this.httpService.send('GET', config);
		}else if(type === 4){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/playlists?id=1',
			};
			return this.httpService.send('GET', config);
		}

	}

}
