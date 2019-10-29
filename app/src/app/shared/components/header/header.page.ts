import { Component, OnInit, Input } from '@angular/core';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-header',
  templateUrl: './header.page.html',
  styleUrls: ['./header.page.scss']
})
export class HeaderPage implements OnInit {
  @Input() title: string;
  @Input() isBackButton: boolean = true;
  constructor(private navCtr: NavController) {}

  ngOnInit() {}

  back() {
    //   console.log(this.navCtr['length()']);
    this.navCtr.back({ animated: true });
  }
}
