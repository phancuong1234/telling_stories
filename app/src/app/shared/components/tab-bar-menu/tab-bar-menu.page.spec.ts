import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TabBarMenuPage } from './tab-bar-menu.page';

describe('TabBarMenuPage', () => {
  let component: TabBarMenuPage;
  let fixture: ComponentFixture<TabBarMenuPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TabBarMenuPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TabBarMenuPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
