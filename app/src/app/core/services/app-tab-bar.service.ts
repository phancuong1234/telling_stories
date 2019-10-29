import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';

@Injectable()
export class AppTabBarService {

  private preventTabClick = new Subject<any>();

  constructor() {}

  setStatus(status) {
    this.preventTabClick.next(status);
  }

  checkPreventClick() {
    return this.preventTabClick.asObservable();
  }
}
