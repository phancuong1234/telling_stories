import { Component, OnInit } from '@angular/core';
import { MypageService } from './mypage.service'

@Component({
	selector: 'app-mypage',
	templateUrl: './mypage.page.html',
	styleUrls: ['./mypage.page.scss'],
})
export class MypagePage implements OnInit {

	constructor(
		private mypageService: MypageService,
		) { }

	ngOnInit() {
	}

}
