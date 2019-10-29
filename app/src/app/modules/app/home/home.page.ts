import { Component, OnInit, ViewChild  } from '@angular/core';
import { IonSlides } from '@ionic/angular';
import { HomeService } from './home.service';
import { LoadingController } from '@ionic/angular';
//import { AppTabBarService } from 'src/app/core/services/app-tab-bar.service';

@Component({
	selector: 'app-home',
	templateUrl: './home.page.html',
	styleUrls: ['./home.page.scss'],
})
export class HomePage implements OnInit {
	@ViewChild(IonSlides, {static: false} ) slides: IonSlides;
	//Configuration for each Slider
	slideOpts = {
		autoplay: {
			delay: 2000
		},
		isBeginningSlide: true,
		initialSlide: 0,
		spaceBetween: 5
	};
	listTopSlide;
	listStoryNew;
	listStoryRecommend;
	listStoryPopularity;
	emptyDatalistTopSlide = false;
	emptyDatalistStoryNew = false;
	emptyDatalistStoryRecommend = false;
	emptyDatalistStoryPopularity = false;
	loaderToShow: any;

	constructor(
		private homeService: HomeService,
		private loadingController: LoadingController,
		//private appTabBarService: AppTabBarService
		) {}

	ngOnInit() {
		//this.appTabBarService.setStatus(true);
	}
	// get event slide channge
	SlideDidChange(event) {
		this.slides.startAutoplay();
	}

	ionViewWillLeave() {
		this.listTopSlide = null;
		this.listStoryNew = null;
		this.listStoryRecommend = null;
		this.listStoryPopularity = null;
		this.slides.stopAutoplay();
	}

	async ionViewWillEnter() {
		//this.appTabBarService.setStatus(true);
		const token= localStorage.getItem('token');
		this.showLoader();
		const topSlide = await this.homeService.getListTopSlide();
		if (topSlide) {
			this.listTopSlide = topSlide.data;
			if (topSlide.data.length === 0) {
				this.emptyDatalistTopSlide = true;
			}
		}
		const storyNew = await this.homeService.getListStoryNew();
		if (storyNew) {
			this.listStoryNew = storyNew.data;
			if (storyNew.data.length === 0) {
				this.emptyDatalistStoryNew = true;
			}
		}

		const storyRecommend = await this.homeService.getListStoryRecommend();
		if (storyRecommend) {
			this.listStoryRecommend = storyRecommend.data;
			if (storyRecommend.data.length === 0) {
				this.emptyDatalistStoryRecommend = true;
			}
		}

		const storyPopularity = await this.homeService.getListStoryPopularity();
		if (storyPopularity) {
			this.listStoryPopularity = storyPopularity.data;
			if (storyPopularity.data.length === 0) {
				this.emptyDatalistStoryPopularity = true;
			}
		}
		this.hideLoader();
		this.slides.startAutoplay();
		//this.appTabBarService.setStatus(false);
	}

	async doRefresh(event) {

		//this.appTabBarService.setStatus(true);
		setTimeout(() => {
			event.target.complete();
		}, 1000);
		const topSlide = await this.homeService.getListTopSlide();
		if (topSlide) {
			this.listTopSlide = topSlide.data;
			if (topSlide.data.length === 0) {
				this.emptyDatalistTopSlide = true;
			}
		}
		const storyNew = await this.homeService.getListStoryNew();
		if (storyNew) {
			this.listStoryNew = storyNew.data;
			if (storyNew.data.length === 0) {
				this.emptyDatalistStoryNew = true;
			}
		}

		const storyRecommend = await this.homeService.getListStoryRecommend();
		if (storyRecommend) {
			this.listStoryRecommend = storyRecommend.data;
			if (storyRecommend.data.length === 0) {
				this.emptyDatalistStoryRecommend = true;
			}
		}

		const storyPopularity = await this.homeService.getListStoryPopularity();
		if (storyPopularity) {
			this.listStoryPopularity = storyPopularity.data;
			if (storyPopularity.data.length === 0) {
				this.emptyDatalistStoryPopularity = true;
			}
		}
		//this.appTabBarService.setStatus(false);
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
