import { ComponentFixture, TestBed } from '@angular/core/testing';
import { MatchResultPage } from './match-result.page';

describe('MatchResultPage', () => {
  let component: MatchResultPage;
  let fixture: ComponentFixture<MatchResultPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(MatchResultPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
