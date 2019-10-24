import { Component, OnInit, ViewChild  } from '@angular/core';
import { IonSlides } from '@ionic/angular';
import { HomeService } from './home.service';

@Component({
	selector: 'app-home',
	templateUrl: './home.page.html',
	styleUrls: ['./home.page.scss'],
})
export class HomePage implements OnInit {
	@ViewChild(IonSlides, {static: false} ) slides: IonSlides;
	sliderOne: any;

	//Configuration for each Slider
	slideOpts = {
		autoplay: {
			delay: 2000
		},
		isBeginningSlide: true,
		initialSlide: 0,
		spaceBetween: 10
	};

	listStoryNew;
	listStoryPopularity;
	emptyDatalistStoryNew = false;

	constructor(
		private homeService: HomeService,
		) { 
		this.sliderOne =
		{
			isBeginningSlide: true,
			isEndSlide: false,
			slidesItems: [
			{
				id: 1,
				image: '../../../../assets/images/home/con_ech.jpg'
			},
			{
				id: 2,
				image: '../../../../assets/images/home/vit-con-xau-xi.jpg'
			},
			{
				id: 3,
				image: '../../../../assets/images/home/Chang_coc_lay_vo_tien.jpg'
			}
			]
		};

	}

	ngOnInit() {

	}
	// get event slide channge
	SlideDidChange(event) {
		this.slides.startAutoplay();
	}

	async ionViewWillEnter() {
		const storyNew = await this.homeService.getListStoryNew();
		if (storyNew) {
			this.listStoryNew = storyNew.data;
			if (storyNew.data.length === 0) {
				this.emptyDatalistStoryNew = true;
			}
		}else{
			alert('ko');
		}
	}



	// async ionViewWillEnter(){
		// 	const storyNew = await this.homeService.getListStoryNew();
		// 	if (storyNew) {
			// 		this.listStoryNew = storyNew.data;
			// 		if (storyNew.data.length === 0) {
				// 			this.emptyDatalistStoryNew = true;
				// 		}
				// 	}

				// }



			}
