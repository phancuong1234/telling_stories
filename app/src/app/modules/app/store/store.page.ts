import { Component, OnInit, ViewChild } from '@angular/core';
import { StoreService } from './store.service'
import { IonSlides, IonInfiniteScroll, LoadingController } from '@ionic/angular';
import { IonContent } from '@ionic/angular';
declare var $: any;

@Component({
	selector: 'app-store',
	templateUrl: './store.page.html',
	styleUrls: ['./store.page.scss'],
})
export class StorePage implements OnInit {
	@ViewChild('slides', {static: true}) slides: IonSlides;
	@ViewChild(IonContent, {static: false}) content: IonContent;
	@ViewChild(IonInfiniteScroll, {static: false}) infiniteScroll: IonInfiniteScroll;
	listMenu= ['LỊCH SỬ','YÊU THÍCH','TẢI XUỐNG','DANH SÁCH ĐÃ TẠO'];
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

	constructor(
		private storeService: StoreService,
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
		await this.storeService.getListStoryStore(this.tabId, offset).then(
			async res => {
				if (res.data.length > 0) {
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
