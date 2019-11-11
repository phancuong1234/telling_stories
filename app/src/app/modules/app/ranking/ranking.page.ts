import { Component, OnInit, ViewChild } from '@angular/core';
import { RankingService } from './ranking.service'
import { IonSlides, IonInfiniteScroll, LoadingController } from '@ionic/angular';
import { IonContent } from '@ionic/angular';
declare var $: any;

@Component({
	selector: 'app-ranking',
	templateUrl: './ranking.page.html',
	styleUrls: ['./ranking.page.scss'],
})
export class RankingPage implements OnInit {
	@ViewChild('slides', {static: true}) slides: IonSlides;
	@ViewChild(IonContent, {static: false}) content: IonContent;
	@ViewChild(IonInfiniteScroll, {static: false}) infiniteScroll: IonInfiniteScroll;
	listMenu= ['HOT NHẤT TUẦN', 'HOT NHẤT THÁNG', 'VIDEO', 'BÀI TEST'];
	storyList = [];
	tabSelected: number;
	tabId= 1;
	offset = 0;
	loaderToShow: any;
	emptyData: boolean;

	slideOpts = {
		initialSlide: 0,
		spaceBetween: 10,
		pagination: false
	};
	token= localStorage.getItem('token');

	constructor(
		private rankingService: RankingService,
		private loadingController: LoadingController
		) { }

	ngOnInit() {
	}

		async ionViewDidEnter() {
		this.content.scrollToTop();
		this.tabSelected = 1;
		await this.getListStoryFromAPI(0);
	}
	async getListStoryFromAPI(offset) {
		this.showLoader();
		this.storyList = [];
		await this.rankingService.getListRanking(this.token, this.tabId, offset).then(
			async res => {
				if (res && res.data.length > 0) {
					this.emptyData = false;
					this.storyList = res.data;
					setTimeout(() => this.addHeight(res.data.length), 500);
				}
				else {
					this.emptyData = true;
				}
				this.hideLoader();
			}
			);
	}

	addHeight(dataLength) {
		if (dataLength === 1) {
			$('ion-grid').append('<ion-row style="width: 100; height: 250px;"></ion-row>');
		}
		if (dataLength === 2) {
			$('ion-grid').append('<ion-row style="width: 100; height: 250px;"></ion-row>');
		} else {
			return;
		}
	}

	async ionSlideDidChange(evt) {
		//this.infiniteScroll.disabled = false;
		const tmp = await this.slides.getActiveIndex();
		if(tmp === 0){
			this.tabId = 1;
		}
		if(tmp === 1){

			this.tabId = 2;
		}
		if(tmp === 2){
			this.tabId = 3;
		}
		if(tmp === 3){
			this.tabId = 4;
		}

		this.tabSelected = tmp + 1;
		this.offset = 0;
		await this.getListStoryFromAPI(0);
	}

	onSelectTab(tab) {
		this.slides.slideTo(tab - 1);
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
