import { TestBed } from '@angular/core/testing';

import { MypageService } from './mypage.service';

describe('MypageService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: MypageService = TestBed.get(MypageService);
    expect(service).toBeTruthy();
  });
});
