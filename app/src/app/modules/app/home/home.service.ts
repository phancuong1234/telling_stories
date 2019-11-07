import { Injectable } from '@angular/core';
import { HttpHeaders, HttpClient  } from '@angular/common/http';
import { HttpService } from './../../../core/services/http.service';





@Injectable({
	providedIn: 'root'
})
export class HomeService {

	constructor(
		private http: HttpClient,
		private httpService: HttpService
		) { }

	async getListTopSlide(token: any): Promise<any> {
		const httpOptions = {
			headers: new HttpHeaders({
				'token': token
			})
		}; 
		return this.http.get('http://telling_stories.test/api/story/top_slide',httpOptions)
		.toPromise()
		.then(res => console.log(res))
		.catch(error => console.log('loi'));
	}

}
