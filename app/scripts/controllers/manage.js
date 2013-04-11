'use strict';


angular.module('jspratleyApp').controller('ManageCtrl', function($scope, $rootScope, $http, Api) {
    
    console.log('ManageCtr', $rootScope);


	
	
	$scope.gridOptions = { 
        data: 'App.projects',
		rowTemplate: '<div style="height: 100%" ng-class="{green: row.getProperty(\'age\')  < 30}"><div ng-repeat="col in visibleColumns()" class="ngCell col{{$index}} {{col.cellClass}}" ng-cell></div></div>',
		rowHeight: 60,
		multiSelect: false,
		sortinfo: { field: 'title', direction: 'ASC'/'asc' || 'desc'/'DESC'},
		useExternalSorting: true,
		pagingOptions: { 
			pageSizes: [10, 25, 50, 100, 200], 
			pageSize: 10, 
			totalServerItems: 0, 
			currentPage: 1 
		},
		enablePaging: false,
		selectRow: function (rowIndex, state){
			console.log('selectRow', rowIndex, state);
		},
		selectItem: function (itemIndex, state){
			console.log('selectItem', itemIndex, state);
		},
        columnDefs: [
	       	{
        		field:'image', 
        		displayName:'Image',
        		width: 75,
        		cellTemplate: "<div ng-class=\"'ngCellText colt' + $index\"><span ng-cell-text><img ng-src='{{COL_FIELD}}' style='width:50px;'/></span></div>"
	        }, 
        	{
        		field:'title', 
        		displayName:'Coupon', 
        		enableFocusedCellEdit: false,
        		editableCellTemplate: "<input ng-cell-input ng-class=\"$index\" ng-model=\"COL_FIELD\" />",
        		cellTemplate: "<div ng-class=\"'ngCellText colt' + $index\"><span ng-cell-text>{{COL_FIELD}}</span></div>"
        	}, 
        	{
        		field:'startdate', 
        		displayName:'Start Date',
        		cellTemplate: "<span ng-cell-text>{{COL_FIELD | date:App.settings.config.dateformat}}</span>"
        	},
        	{
        		field:'enddate', 
        		displayName:'End Date',
        		cellTemplate: "<span ng-cell-text>{{COL_FIELD | date:App.settings.config.dateformat}}</span>"
        	},
        	{
        		field:'project', 
        		displayName:'Project'
        	},
        	{
        		field:'published', 
        		displayName:'Published',
        		width: 60
        	},
        	{
        		field: '',
        		displayName: 'Actions',
        		width: 100,
        		cellTemplate: '<div class="btn-group"><button ng-click="Coupons.select(COL_FIELD); Coupons.edit(COL_FIELD);" data-toggle="modal" href="#add-modal" ng-model="coupon" title="Edit Coupon" class="edit-btn btn btn-small" rel="tooltip"><i class="icon-edit"></i></button><button ng-click="Coupons.destroy(COL_FIELD);" ng-model="coupon" title="Delete Coupon" class="delete-btn btn-small btn btn-danger" rel="tooltip"><i class="icon-trash"></i></button></div>'
        	}
        	
        ]
    };



	
	$scope.init = function(){
		Api.get('projects', function(results){
			$rootScope.App.projects = results;
			console.log(results, $scope);
		});
	};
	
	

});
