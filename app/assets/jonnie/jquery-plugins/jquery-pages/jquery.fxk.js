/**
 * @author Jonnie
 */
(function($){
	
	var settings;

	$.fn.fxk = function( selector, options ) {
	
	settings = $.extend({
		
			//Controls
			pageControllerType: 'append',
			pageControlsId: '#pagecontrols',
			pageControlsClass: '.controlbar',
			pageControlsHolder: null,
			pageControlsWrap: 'ul',
			
			//Single Control
			pageControlWrap: 'li',
			pageControlLabel: 'title',
			
			//Built Controls
			pageNextControl: '#next',
			pagePrevControl: '#prev',
			pageFirstControl: '#first',
			pageLastControl: '#last',
			
			//Current Page
			selectedControlClass: '.selected',
			selectedPage: 0,
			
			//Effects
			pageHideEffect: null,
			pageShowEffect: null
			
			
		}, options || {});
		
		//This selects all items with the selector
		$.each($(selector), function(i, obj){
			
			window.console.log( i + ' ' + obj.title );
			
		});
		
	
		switch( settings.pageControllerType )
		{
			case 'append':
				window.console.log('Append Controls' + buildControls());
				$(this).append( buildControls() );
			break;
			
			case 'inject':
				window.console.log('Inject Controls');
			break;
		}
		
		
		//Event Handlers for Controls
		$(settings.pageNextControl).click(function(){
			window.console.log('Next Page');
		});
		$(settings.pagePrevControl).click(function(){
			window.console.log('Prev Page');
		});
		$(settings.pageFirstControl).click(function(){
			window.console.log('First Page');
		});
		$(settings.pageLastControl).click(function(){
			window.console.log('Last Page');
		});
		
		
		
		
		
		
		
		return this;
	};
	
	

	
	var buildControls = function()
	{
		var html = '';
			html += '<div id="'+settings.pageControlsId+'">';
			html += '<a href="#" id="first">First</a> ';
			html += '<a href="#" id="prev">Prev</a> ';
			html += '<a href="#" id="next">Next</a> ';
			html += '<a href="#" id="last">Last</a>';
			html += '</div>';
		return html;
	}
	
	
	var checkController = function()
	{
		
	}
	
	var handleControlSelect = function()
	{
		
	}
	
})(jQuery);