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

	async getListTopSlide(): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/top_slide',
		};
		return this.httpService.send('GET', config);
	}

	async getListStoryNew(): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/new',
		};
		return this.httpService.send('GET', config);
	}


	async getListStoryRecommend(): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/recommend',
		};
		return this.httpService.send('GET', config);
	}


	async getListStoryPopularity(): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/popularity',
		};
		return this.httpService.send('GET', config);
	}
}
