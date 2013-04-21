'use strict';

var jspratleyApp = angular.module('jspratleyApp', ['ngGrid'])
  .config(['$routeProvider', function($routeProvider) {
    var routeResolver = {
        delay : function($q, $timeout) {
            var delay = $q.defer();
            $timeout(delay.resolve, 500);
            return delay.promise;
        }
    };
    
    $routeProvider
      .when('/', {
        templateUrl: 'views/about.html',
        controller: 'MainCtrl',
        resolve: routeResolver
      })
      .when('/about', {
        templateUrl: 'views/about.html',
        controller: 'AboutCtrl',
        resolve: routeResolver
      })
      .when('/portfolio', {
        templateUrl: 'views/portfolio.html',
        controller: 'PortfolioCtrl',
        resolve: routeResolver
      })
      .when('/contact', {
        templateUrl: 'views/contact.html',
        controller: 'ContactCtrl',
        resolve: routeResolver
      })
      .when('/manage', {
        templateUrl: 'views/manage.html',
        controller: 'ManageCtrl',
        resolve: routeResolver
      })
      .otherwise({
        redirectTo: '/'
      });
  }]);


/* ======================[ @TODO: GLobal app controller ]====================== */
jspratleyApp.controller('AppCtrl', function($scope, $rootScope, $http, $compile, Api) {
	//https://dl.dropbox.com/u/26906414/jonniespratley.me/jonnie/
	$rootScope.cdn = '/assets/jonnie/';

	$rootScope.App = {
		Api: Api,
		projects:{},
		syncProjects: function(items){
		    if(!items){
		        items = $rootScope.App.content.portfolio.data; 
		    }
			angular.forEach(items, function(o){
				Api.create('projects', o, function(result){
					console.log('API-save', o, result);
				});
			});
			return items;
		},
		liveProjects:function(){
		    $rootScope.App.Api.get('projects', null, function(data){
                $rootScope.App.content.portfolio.data = data;
                return data;
            });
             
		},
		localProjects: function(){
			$http.get('/projects.json').success(function(data){
				$rootScope.App.content.portfolio.data = data;
				return data;
			});
		},
		sitetitle: 'Jonnie Spratley',
		menu: {
			nav: [
			//	{id: null, href: '#/', title: 'Jonnie Spratley'},
				{id: null, href: '#/about', title: 'About'},
				{id: null, href: '#/portfolio', title: 'Portfolio'},
			//	{id: null, href: '#/contact', title: 'Contact'}
			]
		},
		content:{
			profile: {
				title: 'Jonnie Spratley',
				subtitle: 'JavaScript Expert, Application Architect',
				image: '/assets/jonnie/avatar.png',
				data:[
					{ title: 'AppMatrix, Inc.', icon: 'home' },
					{ title: 'Citrus Heights, CA', icon: 'map-marker' },
					{ title: 'jonniespratley', icon: 'facebook' },
					{ title: 'jonniespratley', icon: 'twitter' },
					{ title: 'jonniespratley@me.com', icon: 'envelope-alt' }
				],
				address: 'PO BOX 340091, Sacramento, CA 95834-0091',
				phone: '(916) 802-8618',
				fax: '(916) 515-0347'
			},
			/* ======================[ @TODO: Home page of the website ]====================== */
			home: {
				title: 'Profile',
				body: 'I am excellent listener and communicator who effectively brings information verbally as well as in writing. Highly analytical thinking with demonstrated talent for identifying, scrutinizing, improving, and streamlining complex work processes. \nI am a computer-literate with extensive software proficiency covering wide variety of applications as well as programming all types of web applications. \nI am also a flexible team player who thrives in environments requiring ability to prioritize effectively and juggle multiple concurrent projects, and a driven achiever with exemplary planning and organizational skills, along with a high degree of detail orientation ',
				features: [
					{ slug: 'schedule', icon: 'desktop', image:'polaroid', title: 'Schedule', href: '/schedule', body: 'Just pick your day, time, package and your ready to go!' },
					{ slug: 'about', icon: 'bank', image:'polaroid', title: 'We Come to You', href: '/schedule', body: 'Our detailers come to your residence fully equipped with state of the art trailers ready to take care of business.' },
					{ slug: 'enjoy', icon: 'users', image:'polaroid', title: 'Enjoy', href: '/schedule', body: 'Whether your preparing to sell your vechicle or just want it clean, Lion Solutions has something to fit your needs.' }
				],
				slider:[
					{ slug: 'slider-1', title: 'slider-1', image: 'http://placehold.it/530x320', type: 'active' },
					{ slug: 'slider-2', title: 'slider-2', image: 'http://placehold.it/530x320', type: '' },
					{ slug: 'slider-3', title: 'slider-3', image: 'http://placehold.it/530x320', type: '' }
				],
				/* ======================[ @TODO: Sections of the profile page ]====================== */
				sections: [
					{ 
						slug: 'education', icon: 'book', title: 'Education', 
						data: [
							{ title: 'High School Diploma', subtitle: '', body: '' }
						] 
					}
				]
			},
			portfolio: {
				title: '',
				body: '',
				data: [
					{ id: null, title: 'Web Design', type: 'section', body:'' },
					{ id: null, title: 'Advanced Guide to Flex', type: 'post', image: '/assets/jonnie/images/post_acdguide1.png', body:'' }
				]
			}
		},
		init: function(){
			this.localProjects();
		},
		project:null,
		loadReadme: function(where, el){
			$http.get(where).success(function(data){
				angular.element(el).html(markdown.toHTML(data));
			});	
		},
		selectProject: function(p){
			this.project = p;
			console.log('selectProject', p);
			this.loadReadme('/assets/jonnie/'+p.project+'/README.md', '#project-markdown-content');
		}
	};

	window.App = $rootScope.App;
	App.init();
});
/* ======================[ @TODO: 
# Jonnie Spratley

## DIRECTOR OF PRODUCT DESIGN
### AppMatrix, Inc.

### ADDRESS
8648 Fairmont Way
Fair Oaks, CA 95628

### MOBILE
916-241-3613

### TWITTER
@JonnieSpratley

### FACEBOOK
www.facebook.com/JonnieSpratley

### EMAIL 
JonnieSpratley@me.com

### WEB
www.jonniespratley.com


## Profile
I am excellent listener and communicator who effectively brings information verbally as well as in
writing. Highly analytical thinking with demonstrated talent for identifying, scrutinizing, improving,
and streamlining complex work processes.


I am a computer-literate with extensive software proficiency covering wide variety of applications
as well as programming all types of web applications.


I am also a flexible team player who thrives in environments requiring ability to prioritize
effectively and juggle multiple concurrent projects, and a driven achiever with exemplary planning
and organizational skills, along with a high degree of detail orientation.


## Certifications

ADOBE FLEX 4 EXPERT
Adobe License ADB210125 October 2010

TITANIUM CERTIFIED APPLICATION DEVELOPER
Appcelerator License 0df7b57794565725633a9bc21044a99e July 2012

## Skills & Expertise

• APIs Client / Server
• ActionScript 3 (Intermediate, 3 years experience)
• HTML5 + CSS (Expert, 6 years experience)
• Flex 4 (Expert, 3 years experience)
• Jquery (Expert, 3 year experience)
• JavaScript
• Angular.js
• Node.js
• PHP
• MongoDB
• Unix Cloud Servers
• Wordpress
• Titanium Mobile Developer
• Web Services
• Web Applications
• Web Design
• Web Development
• Git

## Education

### Sierra College - Computer Science, 2005 - 2009
* Rich Internet Applications Club
* Bella Vista H.S. - Diploma, General, 2001 - 2005
* Four Year Varsity Football

## Experience

### DIRECTOR OF PRODUCT DESIGN AT APPMATRIX INC.
* AUGUST 2011 - PRESENT (1 YEAR 6 MONTHS)
Includes many tasks such as: Mobile, API, Platform, etc.


### CO-FOUNDER, DEVELOPER AT CUMULOUS.BIZ
* APRIL 2011 - AUGUST 2011 (5 MONTHS)
Created entire web application framework with custom dashboard and client subscription system. Tons of JavaScript and WordPress Core integration.

### WEB DEVELOPER AT PATTERSON PROPERTIES INC.
* MARCH 2009 - JUNE 2010 (1 YEAR 4 MONTHS)
Various web duties.

### WEB DEVELOPER AT CAL-WEST GRAPHICS
* FEBRUARY 2009 - APRIL 2009 (3 MONTHS)
Worked as a Web Developer creating, designing and maintaining client websites.


### COLDFUSION DEVELOPER AT EVENTREADY
* OCTOBER 2008 - JANUARY 2009 (4 MONTHS)
Worked with the lead Senior Developer architecting a re-creation of the companies current web
application.

### SHIPPING DEPARTMENT AT DEUTSCHE BANK
* OCTOBER 2005 - JUNE 2007 (1 YEAR 9 MONTHS)
Received and stocked company supplies, maintained all product supplies throughout office.


## Publications

### FLEX APPLICATION ARCHITECTURE

FLASH & FLEX DEVELOPERS MAGAZINE MARCH 1, 2009
AUTHORS: JONNIE SPRATLEY

The role of the View in a Cairngorm application is to throw events based on user actions (such as
button clicks, loading, entering of data etc.). And bind to the Model for data representation. (Either
through Value Objects or other structures).


### RICH COMPONENTS WITH FLASH

FLASH & FLEX DEVELOPERS MAGAZINE APRIL 1, 2009
AUTHORS: JONNIE SPRATLEY

Creating Rich Components with Flash and Flex have never been so easy, you just never hear
about, until now. Many designers and developers dislike using the Flash CS4 as there primary
coding IDE when creating applications, website, or even simple banners. Why?


## Code


### GITHUB 
https://github.com/jonniespratley

### BEHANCE
http://www.behance.net/JonnieSpratley

 ]====================== */
'use strict';
jspratleyApp.controller('MainCtrl', function($scope, $rootScope, $http, $document) {

	console.log( 'MainCtr', $rootScope);

});

'use strict';

jspratleyApp.controller('AboutCtrl', function($scope) {
  $scope.awesomeThings = [
    'HTML5 Boilerplate',
    'AngularJS',
    'Testacular'
  ];
});

'use strict';

jspratleyApp.controller('PortfolioCtrl', function($scope, $rootScope) {
	console.log($scope);
	
	$scope.project = {};
	$scope.selectProject = function(p){
		this.project = p;
		console.log('selectProject', p);
	}
	
});

'use strict';

jspratleyApp.controller('ContactCtrl', function($scope) {
  $scope.awesomeThings = [
    'HTML5 Boilerplate',
    'AngularJS',
    'Testacular'
  ];
});

'use strict';
angular.module('jspratleyApp').directive('amSidetap', function() {
  return {
    scope:{
      title: '@',
      image: '@',
      headerbtn: '@',
      rightbtn: '@',
      selected: '@',      
      handles: '@'
    },
    controller : function($scope, $element) {
      var panes = $scope.panes = [];

			$scope.select = function(pane) {
				angular.forEach(panes, function(pane) {
					pane.selected = false;
				});
				pane.selected = true;
			};

			this.addPane = function(pane) {
				if (panes.length === 0)
					$scope.select(pane);
				panes.push(pane);
			};
    },
    template: '<div class="sidetap">'+
      '<div class="stp-nav">'+
      '  <div class="stp-nav-inner">'+
      '    <nav class="stp-nav-list">'+
    '      <a href="#{{pane.id}}" ng-repeat="pane in panes" ng-click="select(pane)" ng-class="{active:pane.selected}"><i class="icon-{{pane.icon}}"></i> {{pane.title}}</a>'+
      '    </nav>'+
      '  </div>'+
      '</div>'+
      '<div class="stp-content" id="content">'+
      '  <header class="stp-fake-header">&nbsp;</header>'+
      '  <div class="stp-overlay nav-toggle">&nbsp;</div>'+
      ' <div ng-transclude></div> '+
      '</div>'+
    '</div>'+
      '',
    restrict: 'E',
    replace: true,
    transclude: true
  };
}).directive('amSidetapContent', function() {
  return {
    require : '^amSidetap',
    scope:{
      id: '@',
      title: '@',
      leftbtn: '@',
      rightbtn: '@',
      selected: '@',      
      handles: '@'
    },
    template: '<div id="{{id}}" ng-class="stp-content-panel {active: selected}"><header class="stp-header">'+
          ''+
          '<a href="javascript:void(0)" class="header-button icon menu"><span>{{rightbtn}}</span></a>'+
          '<h1>{{title}}</h1>'+
    //'<a href="javascript:void(0)" class="header-button cancel right">{{rightbtn}}</a>'+
          //'<a href="javascript:void(0)" class="header-button icon info right"><span>{{rightbtn}}</span></a>'+
          '</header>'+
          '<div class="stp-content-frame">'+
            '<div class="stp-content-body">'+
              '<div ng-transclude>'+
                'Content goes here.'+
              '</div>'+
            '</div>'+
          '</div>'+
        '</div>',
    restrict: 'E',
    replace: true,
    transclude: true,
    link: function postLink(scope, element, attrs, stCtrl) {
       var st = new sidetap();
      angular.element('.header-button.menu').bind('click', st.toggle_nav);
      stCtrl.addPane(scope);

      console.log('Linking function', scope, element, attrs);
    }
  };
});





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

'use strict';

jspratleyApp.factory('Api', ['$http', '$rootScope',
function(http, rootScope) {

    var Api = {
        /**
         * Upload a file and return the file results object
         * @param {Object} file
         * @param {Object} cb
         */
        uploadFile : function(file, appid, callback) {
            var form = new FormData();
            form.append('file', file);
            var xhr = new XMLHttpRequest();
            xhr.onload = function(e) {
                console.log('fileuploaded', this.responseText);
                if (callback) {
                    callback(angular.fromJson(this.responseText));
                }
            };
            xhr.open('POST', '/api/v1/upload?appid=' + appid, true);
            xhr.send(form);
        },
        /**
         * Create a db object on server
         * @param {Object} className
         * @param {Object} data
         * @param {Object} callback
         */
        create : function(model, obj, callback) {
            http.post('/api/v1/projectmanager/' + model, obj).success(function(data) {
                console.log("added object successfully!", obj);
                if (callback) {
                    callback(data);
                }
            }).error(function(response) {
                console.log("error adding object!");
                if (callback) {
                    callback(response);
                }

            });
        },
        /**
         *
         * @param {Object} module - The name of the module.
         * @param {Object} appid - The name of the appid.
         * @param {Object} callback - The callback function to call.
         */
        get : function(model, params, callback) {
            http({
                method : 'GET',
                url : '/api/v1/projectmanager/' + model,
                cache : true,
                params : params
            }).success(function(response) {
                if (callback) {
                    callback(response);
                }
                console.log('App.Api.get.success', response);
            }).error(function(response) {
                if (callback) {
                    callback(response.error || "Cannot get object " + model);
                }
                console.log('App.Api.get.error', response);
            });
        },

        /**
         *
         * @param {Object} className
         * @param {Object} query
         * @param {Object} callback
         */
        destroy : function(model, id, callback) {
            App.log('destroy ' + model, id);

            var c = confirm('Are you sure you want to delete ' + model + ' #ID - ' + id);

            if (c) {

                http.
                delete ('/api/v1/projectmanager/' + model + '/' + id).success(function(data) {
                    console.log('Api:destroy:success', id);
                    if (callback) {
                        callback(data);
                    }
                }).error(function(data) {
                    console.log('Api:destroy:error', id);
                });

            } else {
                return false;
            }
        },
        /**
         * Save a model to the myappmatrix backend.
         * If the Models.datasource.name = 'mongo'; Then send request to mongo db
         * If the Coupons.datasource.name = 'live': Then send request to
         * http://dev.appmatrix.us/Api/save/coupon?id=625&title=Test&body=Updated%20body&callback=test
         * If the Coupons.network = false;
         * Then save the coupon to the local database and update when network changes.
         *
         * @param {String} model
         * @param {Object} data
         * @param {Function} callback
         */
        save : function(model, data, callback) {
            App.log('App.Api.save ' + model, data);

            var options = {
                method : 'POST',
                url : '/api/v1/projectmanager/' + model,
                data : data
            };
            http(options).success(function(result) {
                App.log('save:success', result);
                if (callback) {
                    callback(result);
                }
                console.log('App.Api.save.success', result);
            }).error(function(result) {

                if (callback) {
                    callback(result);
                }
                console.error('App.Api.save.error', result);
            });
        },
        refresh : function() {
        }
    };

    return Api;

}]);
