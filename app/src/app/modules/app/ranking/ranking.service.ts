import { Injectable } from '@angular/core';
import { HttpService } from './../../../core/services/http.service';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';
import { environment } from './../../../../environments/environment';





@Injectable({
	providedIn: 'root'
})
export class RankingService {

	constructor(
		private httpService: HttpService
		) { }

	async getListRanking(token:any, type: number, offset: number): Promise<any> {
		if(type === 1){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/popularity/week',
				headers: token
			};
			return this.httpService.send('GET', config);
		} else if(type === 2){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/story/popularity/month',
				headers: token
			};
			return this.httpService.send('GET', config);
		} else if(type === 3){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/video_user/ranking',
				headers: token
			};
			return this.httpService.send('GET', config);
		}else if(type === 4){
			const config: HttpRequestOpts = {
				url: 'http://telling_stories.test/api/result_test/ranking',
				headers: token
			};
			return this.httpService.send('GET', config);
		}
	}

}
