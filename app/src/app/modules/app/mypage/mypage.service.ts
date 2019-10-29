import { Injectable } from '@angular/core';
import { HttpService } from './../../../core/services/http.service';
import { HttpRequestOpts } from './../../../core/services/http-request-opts';

@Injectable({
	providedIn: 'root'
})
export class MypageService {

	constructor(
		private httpService: HttpService
		) { }
}
