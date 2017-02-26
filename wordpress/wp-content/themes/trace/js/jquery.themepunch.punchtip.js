/**************************************************************************
 * jquery.themepunch.punchquotes.js - jQuery Plugin for testamonial rotator
 * @version: 1.0 (16.11.2011)
 * @requires jQuery v1.2.2 or later 
 * @author themepunch
**************************************************************************/




(function($,undefined){	
	
	
	
	////////////////////////////
	// THE PLUGIN STARTS HERE //
	////////////////////////////
	
	$.fn.extend({
	
		
		// OUR PLUGIN HERE :)
		punchtip: function(options) {
	
		////////////////////////////////
		// SET DEFAULT VALUES OF ITEM //
		////////////////////////////////
		var defaults = {	
			timer: 300			
		};
		
			var options =  $.extend(defaults, options);
			var o = options;
			return this.each(function() {
				var $this = $(this);
		
						
						$this.data('title',$this.attr("title"));
						
						$this.bind({
							mouseenter: function(evt){
								$this=$(this);				
								
								clearTimeout($('body').find("#tooltip").data('tooltiptimer'));
								clearTimeout($('body').find("#tooltip").data('tooltiptimer2'));
								$this.attr("title","");
								showTip($this);
							},
							mouseleave: function(){
								$this=$(this);
								$('body').find("#tooltip").data('tooltiptimer2',setTimeout(function() {$('body').find("#tooltip").cssAnimate({'opacity':'0.0'},{duration:200,queue:false})},100));
								$('body').find("#tooltip").data('tooltiptimer',setTimeout(function() {$('body').find("#tooltip").remove()},320));
								
								$this.attr("title",$this.data('title'));
							}
					
				}); // bind
			}); //each
		} // plugin function
	}) //extend
	
	
		///////////////////////////////
		//  --  LOCALE FUNCTIONS -- //
		///////////////////////////////
		
		function showTip(item){
				var ll=item.offset().left + parseInt(item.css('paddingLeft'),0)+ parseInt(item.css('marginLeft'),0);
				var tt=item.offset().top - getPageScroll() + parseInt(item.css('marginTop'),0) +  parseInt(item.css('paddingTop'),0) + item.height();
				
				if ($('body').find('#tooltip').length==0) 
					$('body').append('<div id="tooltip"><span>'+item.data('title')+'</span></div>');				
				var tool=$('body').find('#tooltip');				
				tool.find('span:first').html(item.data('title'));
				tool.css({'display':'block','opacity':'0.0','left':ll+'px','top':tt+'px'});
				tool.cssAnimate({'opacity':'1.0'},{duration:350,queue:false});
				
			}
			
		//////////////////////////////////////
		// GET THE PAGESCROLL SETTINGS HERE //
		//////////////////////////////////////
		function getPageScroll() {
			var  yScroll;
			if (self.pageYOffset) {
			  yScroll = self.pageYOffset;
			  
			} else if (document.documentElement && document.documentElement.scrollTop) {
			  yScroll = document.documentElement.scrollTop;
			  
			} else if (document.body) {// all other Explorers
			  yScroll = document.body.scrollTop;
			  
			}
			return yScroll;
		}
		
		
})(jQuery);			

				
			

			   