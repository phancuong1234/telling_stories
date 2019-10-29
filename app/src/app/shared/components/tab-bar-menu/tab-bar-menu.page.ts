import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-tab-bar-menu',
  templateUrl: './tab-bar-menu.page.html',
  styleUrls: ['./tab-bar-menu.page.scss'],
})
export class TabBarMenuPage implements OnInit {
  @Input() listMenu: Array<string> = [];
  @Input() position;
  @Input() tabSelected = 1;
  @Output() onSelected: EventEmitter <any> = new EventEmitter();
  constructor() { }

  ngOnInit() {

  }

  onTab(tab: number) {
    this.tabSelected = tab;
    this.onSelected.emit(tab);
  }

}
