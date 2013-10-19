'use strict';

describe('Filter: markdown', function () {

  // load the filter's module
  beforeEach(module('jspratleyApp'));

  // initialize a new instance of the filter before each test
  var markdown;
  beforeEach(inject(function ($filter) {
    markdown = $filter('markdown');
  }));

  it('should return the input prefixed with "markdown filter:"', function () {
    var text = 'angularjs';
    expect(markdown(text)).toBe('markdown filter: ' + text);
  });

});
