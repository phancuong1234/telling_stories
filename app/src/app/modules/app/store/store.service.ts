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
}
