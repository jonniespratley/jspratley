/**
 * jQuery Plugin - Pages
 *
 * @author Jonnie Spratley http://jonniespratley.com
 * @version 0.2
 *
 *
 * Options -
 * 		controlsID: 'pageControls' - The id for the menu. * Required
 * 		controlsClass: 'controlbar' - The class for the menu.
 * 		controlsTarget: null - The target where the navigation will be injected.
 * 		controlsWrap: 'ul' - The tag to wrap the whole menu for all pages.
 * 		controlWrap: 'li' - The tag to wrap each menu item.
 * 		pageTitle: 'title' - The attribute that will be the name of the link.
 * 		selectedPageClass: null - The class for the current page.
 * 		pageHideEffect: null - The effect when a page is hidden.
 * 		pageShowEffect: null - The effect when a page is shown.
 * 		nextPageControl: null - The id of the next page control.
 * 		prevPageControl: null - The id of the prev page control.
 * 		firstPageControl: null - The id of the first page control.
 * 		lastPageControl: null - The id of the last page control.
 * 		selectedPage: 0 - The selected page index
 *
 *
 */
(function($){

	var settings;
	
	$.fn.pages = function( pageClass, pageOptions ){
	

		settings = $.extend({
			controlsID: 'pageControls',
			controlsClass: 'controlbar',
			controlsTarget: null,
			controlsWrap: 'ul',
			controlWrap: 'li',
			pageTitle: 'title',
			selectedPageClass: null,
			pageHideEffect: null,
			pageShowEffect: null,
			nextPageControl: null,
			prevPageControl: null,
			firstPageControl: null,
			lastPageControl: null,
			selectedPage: 0
		}, pageOptions || {});
		
		
		$(settings.nextPageControl).click(function(){
			window.console.log('Next Page');
			
			page_showPage();
			page_selectedPage();
			
		});
		$(settings.prevPageControl).click(function(){
			window.console.log('Prev Page');
			
		});
		$(settings.firstPageControl).click(function(){
			window.console.log('First Page');
			
		});
		$(settings.lastPageControl).click(function(){
			window.console.log('Last Page');
		});

		
		
			//private self variable
			var pageThis = $(this);
			var pageArray = $(this).find(pageClass).get();
			var pageSize = pageArray.length;
			var menuArray;
			
			var me = $(this);
			var size;
			var i = 0;
			var navid = settings.controlsID;
			
			var page_initPage = function(){
			
				size = $(pageClass, me).size();
				
				page_hidePages(pageClass);
				page_buildMenu();
				page_showPage();
				page_selectedPage();
			};
			
			var page_buildMenu = function(){
			var pageMenu = '';
				pageMenu += '<' + settings.controlsWrap + ' id="' + settings.controlsID + '" class="' + settings.controlsClass + '">';
				
				//Loop the page array building the menu
				$(pageArray).each(function(i, obj){
					pageMenu += '<li>';
					pageMenu += '<a href="#" rel="' + (i + 1) + '">' + obj.title + '</a>';
					pageMenu += '</li>';
				});
				
				//Close up the menu
				pageMenu += '</' + settings.controlsWrap + '>';
				
				$(settings.controlsTarget).html(pageMenu);
				
				menuArray = $(settings.controlsTarget).children();
			};
			
			
			var page_showPage = function(){
				if (settings.pageHideEffect) {
					$(me).find(pageClass).hide(settings.pageHideEffect);
				} else {
					$(me).find(pageClass).hide();
				}
				
				var show = $(me).find(pageClass).get(i);
				
				if (settings.pageShowEffect) {
					$(show).show(settings.pageShowEffect);
				} else {
					$(show).show();
				}
			};
			
			
			var page_selectedPage = function(){
				$(this).find(settings.controlWrap).removeClass('selected');
				
				var show = $(settings.controlsID).find('a[rel]').get(0 + 1);
				$(show).addClass(settings.highlightClass);
				
				settings.selectedPage = i + 1;
				
				$(settings.controlsID).find('a').removeClass(settings.selectedPageClass);
				$(settings.controlsID).find('a[rel="' + settings.selectedPage + '"]').addClass(settings.selectedPageClass);
				
			};
			
			
			var page_hidePages = function(whatPages){
				$(whatPages, pageThis).hide();
			};
			
			page_initPage();
			
			
			
			$("a", '#' + settings.controlsID ).bind('click', function(event){
			
				var pagenum = event.currentTarget.rel;
				i = pagenum - 1;
				
				$(event.currentTarget).addClass(settings.highlightClass);
				
				page_showPage();
				page_selectedPage();
				
				return false;
			});
			
			
			
	};//$.fn.pages
	
	
	$.setSelectedPage = function(num){
		alert('Selected Page is:' + settings.selectedPage);
	};
	
})(jQuery);
