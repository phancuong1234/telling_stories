import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BootPage } from './boot.page';

describe('BootPage', () => {
  let component: BootPage;
  let fixture: ComponentFixture<BootPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BootPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BootPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
