import { Component, OnInit } from '@angular/core';
import { DetailService } from './detail.service';
import { ActivatedRoute } from '@angular/router';

@Component({
	selector: 'app-detail',
	templateUrl: './detail.page.html',
	styleUrls: ['./detail.page.scss'],
})
export class DetailPage implements OnInit {
	state= 0;
	story_id;
	story_detail={};
	user_id
	detail;
	constructor(
		private detailService: DetailService,
		private route: ActivatedRoute,
		) { }

	ngOnInit() {
		this.story_id = +this.route.snapshot.paramMap.get('id');
	}

	async ionViewWillEnter() {
		console.log(this.story_id);
		const detail = await this.detailService.getDetail(this.story_id, this.user_id);
		if (detail) {
			this.story_detail = detail.data;
			console.log(this.story_detail);
		}
	}

	async myClick(state,story_id, user_id){
		const topSlide = await this.detailService.addFavorite();
	}

}
