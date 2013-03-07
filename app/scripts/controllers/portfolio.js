'use strict';

jspratleyApp.controller('PortfolioCtrl', function($scope, $rootScope) {
	console.log($scope);
	
	$scope.project = {};
	$scope.selectProject = function(p){
		this.project = p;
		console.log('selectProject', p);
	}
	
});
