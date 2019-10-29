import { Component, OnInit, ViewChild } from '@angular/core';
import { ClassifyService } from './classify.service'
import { IonSlides, IonInfiniteScroll, LoadingController } from '@ionic/angular';
import { IonContent } from '@ionic/angular';
declare var $: any;

@Component({
	selector: 'app-classify',
	templateUrl: './classify.page.html',
	styleUrls: ['./classify.page.scss'],
})
export class ClassifyPage implements OnInit {
	@ViewChild('slides', {static: true}) slides: IonSlides;
	@ViewChild(IonContent, {static: false}) content: IonContent;
	@ViewChild(IonInfiniteScroll, {static: false}) infiniteScroll: IonInfiniteScroll;
	//listMenu = ['HOT NHẤT','MỚI NHẤT'];
	listMenu= [];
	listMenu2= [];
	listAge: any;
	listCategory: any;
	storyList = [];
	emptyData: boolean;
	loaderToShow: any;
	tabSelected: number;
	tabId = 1;
	offset = 0;
	categoryId;
	listCategoryId= [];

	slideOpts = {
		initialSlide: 0,
		spaceBetween: 10,
		pagination: false
	};

	constructor(
		private classifyService: ClassifyService,
		private loadingController: LoadingController
		) { }

	ngOnInit() {
		this.listAge = [];
		this.getListStoryFromAPI(0);
	}

	async ionViewDidEnter() {
		this.content.scrollToTop();
		this.tabSelected = 1;
		/*const ageRes = await this.classifyService.getAge();
		this.listAge = ageRes.data;*/
		const categoryRes = await this.classifyService.getCategory();
		this.listCategory = categoryRes.data;
		this.listMenu.push({tabId: 1, name: 'HOT NHẤT'});
		this.listMenu.push({tabId: 2, name: 'MỚI NHẤT'});
		this.listCategory.map(g => this.listMenu.push({tabId: 3, id: g.id, name: g.name }));
		//this.listMenu.map(g => this.getListStoryFromAPI(g.id));
		this.listMenu.map(g => this.listMenu2.push(g.name));
		await this.getListStoryFromAPI(0);
	}

	async getListStoryFromAPI(offset) {
		this.showLoader();
		this.storyList = [];
		await this.classifyService.getListClassifyPopularity(this.tabId, offset, this.categoryId).then(
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

	onSelectTab(tab) {
		this.slides.slideTo(tab - 1);
	}


	async ionSlideDidChange(evt) {
		//this.infiniteScroll.disabled = false;
		const tmp = await this.slides.getActiveIndex();
		const categoryRes = await this.classifyService.getCategory();
		this.listCategory= categoryRes.data;
		this.listCategory.map(g =>
			this.listCategoryId.push(g.id)

			);
		//alert('kk');
		//alert(this.categoryId.length);
		//this.listCategory = categoryRes.data;
		
		if(tmp === 0){
			this.tabId = 1;
		}
		if(tmp === 1){

			this.tabId = 2;
		}
		if(tmp > 1){
			this.tabId = 3;
			for (var i = 0; i < this.listCategoryId.length; ++i) {
				this.categoryId= this.listCategoryId[i];
				break;
			}
		}

		this.tabSelected = tmp + 1;
		this.offset = 0;
		await this.getListStoryFromAPI(0);
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
