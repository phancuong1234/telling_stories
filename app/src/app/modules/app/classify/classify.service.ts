import { Injectable } from '@angular/core';
import { HttpService } from './../../../core/services/http.service';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';

@Injectable({
	providedIn: 'root'
})
export class ClassifyService {

	constructor(
		private httpService: HttpService
		) { }

	async getCategory(token: any): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/category/all',
			headers: token
		};
		return this.httpService.send('GET', config);
	}

	async getAge(token: any): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/age/all',
			headers: token
		};
		return this.httpService.send('GET', config);
	}
	

	async getListClassifyPopularity(token: any, type: number, offset: number, category_id: number, age_id: number): Promise<any> {
		if(type == 1){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/popularity',
				headers: token
			};
			return this.httpService.send('GET', config);
		}
		if(type == 2){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/new',
				headers: token
			};
			return this.httpService.send('GET', config);
		}
		if(type == 3){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/age',
				params: { age_id: age_id},
				headers: token
			};
			return this.httpService.send('GET', config);
		}
		if(type == 4){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/category',
				params: { id: category_id},
				headers: token
			};
			return this.httpService.send('GET', config);
		}

		
	}
}
