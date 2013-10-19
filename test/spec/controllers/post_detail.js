'use strict';

describe('Controller: PostDetailCtrl', function () {

  // load the controller's module
  beforeEach(module('jspratleyApp'));

  var PostDetailCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller) {
    scope = {};
    PostDetailCtrl = $controller('PostDetailCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
