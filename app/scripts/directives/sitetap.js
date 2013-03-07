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




