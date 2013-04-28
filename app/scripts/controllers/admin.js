'use strict';

angular.module('jspratleyApp').controller('AdminCtrl', function ($scope, $rootScope, $http, Api) {
    


	$scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Testacular'
    ];


	$scope.Admin = {
		collection: 'projects',
		selectedModel: null,
		model: {
			name: 'projects',
			data: [
				{title: 'Item 1', body: 'This is the body'}
			],
			fetch: function(collection, cb){
				Api.get(collection, null, function(data){
					if(cb){
						cb(data);
					}
					$scope.Admin.model.data = data;
					console.log(data);
				});
				
				//$http.get('/api/v1/projectmanager/'+collection).success(function(data){});
			}
		},
		init: function(){
			//this.model.fetch('projects');
			return this;
		},
		render: function(){
			
		},
		save: function(model){
			Api.save($scope.Admin.model.name, model, function(data){
				console.log(data);
			});
		}
	};




	window.Admin = $scope.Admin.init();
 	$scope.filterOptions = {
        filterText: "",
        useExternalFilter: true
    };
    $scope.pagingOptions = {
        pageSizes: [5, 25, 50, 100, 200, 500, 1000],
        pageSize: 25,
        totalServerItems: 0,
        currentPage: 1
    };	
    $scope.setPagingData = function(data, page, pageSize){	
        var pagedData = data.slice((page - 1) * pageSize, page * pageSize);
        $scope.myData = pagedData;
        $scope.pagingOptions.totalServerItems = data.length;
        if (!$scope.$$phase) {
            $scope.$apply();
        }
    };
    $scope.getPagedDataAsync = function (pageSize, page, searchText) {
        setTimeout(function () {
            var data;
            if (searchText) {
                var ft = searchText.toLowerCase();

				$scope.Admin.model.fetch('projects', function(data){
					data = largeLoad.filter(function(item) {
                        return JSON.stringify(item).toLowerCase().indexOf(ft) != -1;
                    });
					$scope.setPagingData(data,page,pageSize);
				});
				

            } else {
				$scope.Admin.model.fetch('projects', function(data){
					$scope.setPagingData(data, page, pageSize);
				});
            }
        }, 100);
    };

    $scope.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage);

    $scope.$watch('pagingOptions', function () {
        $scope.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage, $scope.filterOptions.filterText);
    }, true);

    $scope.$watch('filterOptions', function () {
        $scope.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage, $scope.filterOptions.filterText);
    }, true);   



	$scope.mySelections = [];

    $scope.gridOptions = {
		data: 'Admin.model.data',
		columnDefs: [		
		/*
			{
				field: 'project', 
			//	displayName: 'Project',
			//	cellTemplate: '<div ng-class="{green: row.getProperty(col.field) > 30}"><img ng-src="/assets/jonnie/{{row.getProperty(col.field)}}/thumb.png"/><div class="ngCellText">{{row.getProperty(col.field)}}</div></div>'
			},
			*/
			{field: 'title', displayName: 'Title'},
			{
				field:'description', 
				displayName:'Description', 
				cellTemplate: '<div ng-class="{green: row.getProperty(col.field) > 30}"><div class="ngCellText">{{row.getProperty(col.field)}}</div></div>'
			},
			{field: 'type', displayName: 'Type'},
		],
        enablePaging: true,
		showFooter: true,
		selectedItems: $scope.mySelections,
		multiSelect: false,
        pagingOptions: $scope.pagingOptions,
        filterOptions: $scope.filterOptions,
		selectRow: function(index, state){
			console.log(index, state);
		}
    };

	$scope.Admin.selectedModel = $scope.$watch($scope.mySelections[0]);
	
	$scope.loadData = function(name){
		$scope.Admin.model.fetch(name);
	}


});
