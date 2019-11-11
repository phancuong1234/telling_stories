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

	listMenu= ['HOT NHẤT', 'MỚI NHẤT'];
	listAge: any;
	listCategory: any;
	storyList = [];
	emptyData: boolean;
	loaderToShow: any;
	tabSelected: number;
	tabId = 1;
	offset = 0;
	categoryId;
	ageId;
	listCategoryId= [];
	listAgeId= [];

	slideOpts = {
		initialSlide: 0,
		spaceBetween: 10,
		pagination: false
	};
	
	token= localStorage.getItem('token');
	constructor(
		private classifyService: ClassifyService,
		private loadingController: LoadingController
		) { }

	ngOnInit() {
		
	}

	async ionViewDidEnter() {
		this.content.scrollToTop();
		this.tabSelected = 1;
		const ageRes = await this.classifyService.getAge(this.token);
		if(ageRes){
			this.listAge = ageRes.data;
			this.listAge.map(g => this.listMenu.push(g.age));
		}
		
		const categoryRes = await this.classifyService.getCategory(this.token);
		if(categoryRes){
			this.listCategory = categoryRes.data;
			this.listCategory.map(g => this.listMenu.push(g.name));
		}

		await this.getListStoryFromAPI(0);
	}

	async getListStoryFromAPI(offset) {
		this.showLoader();
		this.storyList = [];
		await this.classifyService.getListClassifyPopularity(this.token, this.tabId, offset, this.categoryId, this.ageId).then(
			async res => {
				if (res && res.data.length > 0) {
					this.emptyData = false;
					this.storyList = res.data;
				} else {
					this.emptyData = true;
				}
				this.hideLoader();
			}
			);
	}

	onSelectTab(tab) {
		this.slides.slideTo(tab - 1);
	}


	async ionSlideDidChange(evt) {
		const tmp = await this.slides.getActiveIndex();
		const categoryRes = await this.classifyService.getCategory(this.token);
		if(categoryRes){
			this.listCategory= categoryRes.data;
			this.listCategory.map(g =>
				this.listCategoryId.push(g.id)

				);
		}
		
		this.listAge.map(g =>
			this.listAgeId.push(g.id)

			);
		const index= 2+ this.listAge.length;

		if(tmp === 0){
			this.tabId = 1;
		}else if(tmp === 1){

			this.tabId = 2;
		}else if(tmp > 1 && tmp < this.listAge.length + 2){
			this.tabId = 3;
			for (var i = 0; i < this.listAge.length; ++i) {
				this.ageId= this.listAge[tmp-2]['id'];
			}
		}else{
			this.tabId = 4;
			for (var i = 0; i < this.listCategoryId.length; ++i) {
				this.categoryId= this.listCategoryId[tmp-index];
			}
		}
		
		this.tabSelected = tmp + 1;
		this.offset = 0;
		await this.getListStoryFromAPI(0);
	}

	showLoader() {
		this.loaderToShow = this.loadingController.create({
			spinner: 'lines',
			duration: 4000
		}).then((loading) => {
			loading.present();
		});
	}
	hideLoader() {
		this.loadingController.dismiss();
	}

}
