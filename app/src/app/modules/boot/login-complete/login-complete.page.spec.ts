import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LoginCompletePage } from './login-complete.page';

describe('LoginCompletePage', () => {
  let component: LoginCompletePage;
  let fixture: ComponentFixture<LoginCompletePage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LoginCompletePage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LoginCompletePage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
