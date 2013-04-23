'use strict';

jspratleyApp.controller('PortfolioCtrl', function($scope, $rootScope) {
	console.log($rootScope);
	$scope.predicate = 'modified';
	$scope.reverse = true;
	$scope.project = {};

	$scope.selectProject = function(p){
		this.project = p;
		console.log('selectProject', p);
	}
	
});
