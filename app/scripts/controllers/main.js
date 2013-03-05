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

	var App = {
		sitetitle: 'Jonnie Spratley',
		/* ======================[ @TODO: Website Global navigation ]====================== */
		menu: {
			nav: [
				{id: null, href: '#/', title: 'Home'},
				{id: null, href: '#/about', title: 'About'},
				{id: null, href: '#/portfolio', title: 'Portfolio'},
				{id: null, href: '#/contact', title: 'Contact'}
			]
		},
		content:{
			/* ======================[ @TODO: Profile sidebar of the website ]====================== */
			profile: {
				title: 'Jonnie Spratley',
				subtitle: 'JavaScript Expert, Application Architect',
				image: '/img/avatar.png',
				data:[
					{ title: 'AppMatrix, Inc.', icon: 'home' },
					{ title: 'Citrus Heights, CA', icon: 'map-marker' },
					{ title: 'jonniespratley', icon: 'facebook' },
					{ title: 'jonniespratley', icon: 'twitter' },
					{ title: 'JonnieSpratley@me.com', icon: 'mail' }
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
			$http.get('/README.MD').success(function(data){
				angular.element('#markdown-content').html(markdown.toHTML(data));
			});
		}
	};


	$rootScope.App = App;
	window.App = App;
	
	
	console.log($rootScope);

});
