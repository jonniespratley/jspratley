'use strict';

describe('Directive: sitetap', function () {
  beforeEach(module('jspratleyApp'));

  var element;

  it('should make hidden element visible', inject(function ($rootScope, $compile) {
    element = angular.element('<sitetap></sitetap>');
    element = $compile(element)($rootScope);
    expect(element.text()).toBe('this is the sitetap directive');
  }));
});
