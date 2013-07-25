'use strict';

describe('Service: ParseService', function () {

  // load the service's module
  beforeEach(module('jspratleyApp'));

  // instantiate service
  var ParseService;
  beforeEach(inject(function (_ParseService_) {
    ParseService = _ParseService_;
  }));

  it('should do something', function () {
    expect(!!ParseService).toBe(true);
  });

});
