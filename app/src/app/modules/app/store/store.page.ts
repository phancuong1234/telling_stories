import { Component, OnInit } from '@angular/core';
import { StoreService } from './store.service'

@Component({
	selector: 'app-store',
	templateUrl: './store.page.html',
	styleUrls: ['./store.page.scss'],
})
export class StorePage implements OnInit {

	constructor(
		private storeService: StoreService,
		) { }

	ngOnInit() {
	}

}
