import { Component, OnInit } from '@angular/core';
import { MypageService } from './mypage.service';
import { LoadingController } from '@ionic/angular';

@Component({
	selector: 'app-mypage',
	templateUrl: './mypage.page.html',
	styleUrls: ['./mypage.page.scss'],
})
export class MypagePage implements OnInit {
	loaderToShow: any;
	infoUser= {
		"name": "admin",
        "email": "admin@gmail.com",
        "address": "Đà Nẵng",
        "gender": "Nữ",
        "birthday": "10/2/1998",
        "avatar": "https://firebasestorage.googleapis.com/v0/b/story-255509.appspot.com/o/avatar%2Fimages%20(5).jpg?alt=media&token=2b38498d-cd67-48c3-8ffd-7df5fd700097",
	}
	constructor(
		private mypageService: MypageService,
		private loadingController: LoadingController,
		) { }

	ngOnInit() {
	}

	async ionViewDidEnter() {
		//this.showLoader();

		/*const infoUser = await this.mypageService.getInfoUser();
		if (infoUser) {
			this.listTopSlide = infoUser.data;
			if (topSlide.data.length === 0) {
				this.emptyDatalistTopSlide = true;
			}
		}*/

		//this.hideLoader();

	}

	showLoader() {
		this.loaderToShow = this.loadingController.create({}).then((res) => {
			res.present();
		});
	}

	hideLoader() {
		this.loadingController.dismiss();
	}
}
