import { Injectable } from '@angular/core';
import { HttpHeaders, HttpClient  } from '@angular/common/http';
import { HttpService } from './../../../core/services/http.service';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';





@Injectable({
	providedIn: 'root'
})
export class HomeService {

	constructor(
		private http: HttpClient,
		private httpService: HttpService
		) { }

	async getListTopSlide(token: any): Promise<any> {
		
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/top_slide',
			headers: token
		};
		return this.httpService.send('GET', config);
	}

	async getListStoryNew(token: any): Promise<any> {
		
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/top_slide',
			headers: token
		};
		return this.httpService.send('GET', config);
	}
	async getListStoryRecommend(token: any): Promise<any> {
		
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/top_slide',
			headers: token
		};
		return this.httpService.send('GET', config);
	}
	async getListStoryPopularity(token: any): Promise<any> {
		
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/story/top_slide',
			headers: token
		};
		return this.httpService.send('GET', config);
	}

}
