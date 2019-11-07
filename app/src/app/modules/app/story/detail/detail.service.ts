import { Injectable } from '@angular/core';
import { HttpService } from './../../../../core/services/http.service';
import { HttpRequestOpts } from './../../../../core/services/http-request-opts';

@Injectable({
	providedIn: 'root'
})
export class DetailService {

	constructor(
		private httpService: HttpService
		) { }

	async getDetail(id: number, user_id: number): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/detail',
			params: { id: id, user_id:  1}
		};
		return this.httpService.send('GET', config);
	}

	async addFavorite(): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/top_slide',
		};
		return this.httpService.send('GET', config);
	}

}
