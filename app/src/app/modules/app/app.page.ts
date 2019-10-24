import { Component, OnInit } from '@angular/core';
import { Router, NavigationEnd } from '@angular/router';

@Component({
	selector: 'app-app',
	templateUrl: './app.page.html',
	styleUrls: ['./app.page.scss'],
})
export class AppPage implements OnInit {
	tabSelected: string;
	tabList: Array <string> = [ 'home', 'classify', 'store', 'mypage' ];
	constructor(
		private router: Router,
		) {
		this.router.events.subscribe(event => {
			if (event instanceof NavigationEnd) {
				this.tabSelected = this.router.url.replace('/app/', '');
			}
		});
	}

	ngOnInit() {
	}

}
