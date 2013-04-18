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
        templateUrl: 'views/main.html',
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