/**
 * jQuery Plugin - Pages
 *
 * @author Jonnie Spratley http://jonniespratley.com
 * @version 0.1
 *
 *
 * Options -
 *	menuId: 'menu', //The id for the menu. * Required
 * 	menuClass: 'nav', //The class for the menu.
 * 	menuTarget: null, //The target where the navigation will be injected.
 * 	menuItemWrap: 'ul', //The tag to wrap the whole menu for all pages.
 * 	menuItemBreak: 'li', //The tag to wrap each menu item.
 * 	menuItemLabel: 'title', //The attribute that will be the name of the link
 * 	selectedClass: 'selected', //The class for the current page.
 *
 *
 */
(function($){
	$.fn.pages = function(pageClass, pageOptions){
	
	
		/* ============================================================
		 * the default settings for this plugin
		 * ============================================================ */
		var pageSettings = 
		{
			menuId: 'menu',
			menuClass: 'tabs',
			menuTarget: 'menu_holder',
			menuWrap: 'ul',
			menuItemBreak: 'li',
			menuItemLabel: 'title',
			selectedClass: 'selected',
			hideEffect: null,
			showEffect: null
		
		}
		//If there is any options
		if (pageOptions) {
				//Extends the jQuery object itself. Can be used to add functions into the jQuery namespace and to add plugin methods (plugins).
			$.extend(pageSettings, pageOptions);
		}
		
		return this.each(function(){
		
				//private self variable
			var pageThis = $(this);
			var pageArray = $(this).find(pageClass).get();
			var pageSize = pageArray.length;
			var menuArray;
			
			var me = $(this);
			var size;
			var i = 0;
			var navid = '#' + pageSettings.menuId;
			
			/**
			 *
			 */
			function page_initPage(){
			
						size = $(pageClass, me).size();
				
				
				page_hidePages(pageClass);
				page_buildMenu();
				page_showPage();
				
				dump('Calling page_hidePages(' + pageClass + ')');
				dump('Calling page_buildMenu()');
				dump('Calling page_showPage()');
			}
			
			/**
			 *
			 */
			function page_buildMenu(){
						var pageMenu = '';
				pageMenu += '<' + pageSettings.menuWrap + ' id="' + pageSettings.menuId + '" class="' + pageSettings.menuClass + '">';
				
				//All of the pages that are in the menu
				for (var i = 0; i < pageArray.length; i++) {
								pageMenu += '<li>';
					pageMenu += '<a href="#" rel="' + (i + 1) + '">' + pageArray[i].title + '</a>';
					pageMenu += '</li>';
					
					dump('page_buildMenu() - Page - ' + pageArray[i].title);
				}
				
				pageMenu += '</' + pageSettings.menuWrap + '>';
				
				$('#' + pageSettings.menuTarget).html(pageMenu);
				
				menuArray = $('#' + pageSettings.menuTarget).children();
				
				
				dump('page_buildMenu() - menuArray - ' + menuArray);
			}
			
			/**
			 *
			 * @param {Object} pageNumber
			 */
			function page_showPage(){
				
				if ( pageSettings.hideEffect )
				{
					$(me).find(pageClass).hide(pageSettings.hideEffect);
				} else {
					$(me).find(pageClass).hide();					
				}
				
				var show = $(me).find(pageClass).get(i);
				
				if ( pageSettings.showEffect )
				{
					
					$(show).show( pageSettings.showEffect );
				} else {
					$(show).show();
				}
				
				

				
				
				dump('page_showPage()' + pageArray[i])
			}
			
			/**
			 *
			 * @param {Object} pageNumber
			 */
			function page_selectedPage(){
			
						$(this).find(pageSettings.menuItemBreak).removeClass('selected');
				
				var show = $("#" + pageSettings.menuId).find('a[rel]').get(0 + 1);
				$(show).addClass(pageSettings.highlightClass);
				
				dump('page_selectedPage()' + i + 1);
			}
			
			
			
			
			/**
			 *
			 * @param {Object} whatPages
			 */
			function page_hidePages(whatPages){
						$(whatPages, pageThis).hide();
			}
			
			
			//Init the plugin	
			page_initPage();
			
			
			//Event Listeners
			$("a", '#' + pageSettings.menuId).bind('click', function(event){
			
						dump(pageClass);
				dump('Rel: ' + event.currentTarget.rel);
				dump('Link Clicked');
				
				var pagenum = event.currentTarget.rel;
				i = pagenum - 1;
				
				$(event.currentTarget).addClass(pageSettings.highlightClass);
				
				page_showPage();
				page_selectedPage();
			});
			
			
			
			function dump(obj){
						var d = new Date();
				window.console.log(d.toUTCString() + ' - ' + obj);
				
			}
			
		});//return this.each 			
	};//$.fn.pages
})(jQuery);//function($)

