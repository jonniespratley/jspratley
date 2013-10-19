'use strict';

angular.module('jspratleyApp')
  .controller('PostDetailCtrl', function ($scope, $rootScope, $routeParams) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Testacular'
    ];
		$scope.post = $rootScope.App.Blog.posts[$routeParams.index];
		
		$scope.highlight = function(){
			setTimeout(function(){
				hljs.initHighlighting();
			}, 1000);
		};
		

		
  });
