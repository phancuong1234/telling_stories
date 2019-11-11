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

	async getPlaylist(token: any): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/playlist',
			headers: token
		};
		return this.httpService.send('GET', config);
	}

	async getListStoryStore(token: any, type: number, offset: number, playlist_id: number): Promise<any> {
		if(type === 1){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/history',
				headers: token
			};
			return this.httpService.send('GET', config);
		} else if(type === 2){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/favorite',
				headers: token
			};
			return this.httpService.send('GET', config);
		} else if(type === 3){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/download',
				headers: token
			};
			return this.httpService.send('GET', config);
		}else if(type === 4){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/playlist/story',
				headers: token,
				params: {playlist_id: playlist_id}
			};
			return this.httpService.send('GET', config);
		}

	}

}
