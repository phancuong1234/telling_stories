import { TestBed } from '@angular/core/testing';

import { ClassifyService } from './classify.service';

describe('ClassifyService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ClassifyService = TestBed.get(ClassifyService);
    expect(service).toBeTruthy();
  });
});
