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

	async getCategory(): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/category/all',
		};
		return this.httpService.send('GET', config);
	}

	async getAge(): Promise<any> {
		const config: HttpRequestOpts = {
			url: 'http://telling_stories.test/api/age/all',
		};
		return this.httpService.send('GET', config);
	}
	

	async getListClassifyPopularity(type: number, offset: number, category_id: number, age_id: number): Promise<any> {
		if(type == 1){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/popularity',
			};
			return this.httpService.send('GET', config);
		}
		if(type == 2){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/new',
			};
			return this.httpService.send('GET', config);
		}
		if(type == 3){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/age',
				params: { age_id: age_id}
			};
			return this.httpService.send('GET', config);
		}
		if(type == 4){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/category',
				params: { id: category_id}
			};
			return this.httpService.send('GET', config);
		}

		
	}

/*	async getListClassifyPopularity(offset: any): Promise<any> {
		if(offset === 0){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/popularity',
			};
			return this.httpService.send('GET', config);
		} else if(offset === 1){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/new',
			};
			return this.httpService.send('GET', config);
		}
		
	}*/
}
