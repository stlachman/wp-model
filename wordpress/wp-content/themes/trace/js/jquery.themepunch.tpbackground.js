/**
 * jquery.freshline.portfolio - jQuery Plugin for portfolio gallery 
 * @version: 1.0 (22.11.11)
 * @requires jQuery v1.2.2 or later 
 * @author themepunch
 * All Rights Reserved, use only in freshline Templates or when Plugin bought at Envato ! 
**/






(function($,undefined){	
	
	
	////////////////////////////////////////
	// THE BACKGROUND PLUGIN STARTS HERE //
	///////////////////////////////////////
	
	$.fn.extend({
	
		
		// OUR PLUGIN HERE :)
		tpbackground: function(options) {
	
		
			
		////////////////////////////////
		// SET DEFAULT VALUES OF ITEM //
		////////////////////////////////
		var defaults = {	
			slideshow:0,
			cat:"",
			callback:"false"
		};
		
		options = $.extend({}, $.fn.tpbackground.defaults, options);
		
		return this.each(function() {
		
			var opt=options;
			var top=$(this);			
			
			
			if (opt.callback=="false") {
				top.find('div').each(function(i) {
					var $this=$(this);
					$this.css({'z-index':'2','position':'fixed','margin':'0px','padding':'0px','left':'0px','top':'0px','width':'100%','height':'100%','overflow':'hidden'});
					$this.data('id',i);
				});							
				loadNextBg(top,opt);			
			} else {
				
				loadNextBg(top,opt,opt.cat);
			}
		})
		
		
		//////////////////////////
		// LOAD NEXT BACKGROUND //
		//////////////////////////
		function loadNextBg(top,opt,cat) {
						
			var bgitem=null;
			// CHECK IF THE CATEGORY SELECTED IN THE GALLERY AVAILABLE
			if (cat!=null) {
				
				top.find('div').each(function() {
					var $this=$(this);					
					if ($this.data('category') == cat) bgitem=$this;																	
				});
			} else {
			
				if (top.find('.tp-bg-act-div-container').length == 0) {
					 bgitem=top.find('div:first');	
				 } else {							
					if (top.find('.tp-bg-act-div-container').data('id') < top.find('div').length-1) {
							bgitem=top.find('.tp-bg-act-div-container').next();	
							
					 } else {
							bgitem=top.find('div:first')						
					}
				}
			}
			
			
			if (bgitem!=null) {
					if (!bgitem.hasClass('tp-bg-act-div-container') && bgitem!=null) {
							
							
								// MAKE THE NEW LOADED ITEM UNVISIBLE IF bg-fadein SET
								if (bgitem.hasClass('bg-fadein')) bgitem.css({'opacity':0});
											
								// SET SOURCE ,AND PREPARE THE DIV CONTAINER
								var src = bgitem.data('src');
								if (bgitem.hasClass('bg-tiled')) {
									bgitem.append('<div class="tp-bg-img-intern" style="width:'+$(window).width()+'px;height:'+$(window).height()+'px"><div style="width:100%;height:100%;background-image:url('+src+')"></div></div>');
									
								} else {
									bgitem.append('<img class="tp-bg-img-intern" src="'+src+'">');
								}
								
								
								// MARK ITEM WHICH IS NOW VIEWABLE, AND PREPARE IT TO KILL
								top.find('.tp-bg-act-div-container').addClass("to-kill-soon");
								top.find('.tp-bg-act-div-container').removeClass("tp-bg-act-div-container");
								
								bgitem.addClass("tp-bg-act-div-container");
								
								
								
								bgitem.waitForImages(function() {   
									//setTimeout(function() {
										top.find(".to-kill-soon").animate({'opacity':0},{duration:1500,queue:false});
										top.find(".to-kill-soon").css({'z-index':'1'});
										setTimeout(function() {
												top.find(".to-kill-soon").unbind("resize scroll")
												top.find(".to-kill-soon .tp-bg-img-intern").remove();
												top.find(".to-kill-soon").removeClass("to-kill-soon")},900);
												
										if (opt.slideshow>0) setTimeout(function() {loadNextBg(top,opt);},parseInt(opt.slideshow,0));
										prepareBG(bgitem);						
									//},00);
								});	
					}
			}						
		}
		
		
	
		
		//////////////////////		
		// SET THE LI ITEMS //
		/////////////////////	
		function prepareBG(item) {
			
			$(window).bind('resize scroll', function() {resizeBackground(item)});						
			resizeBackground(item);
			if (item.hasClass('bg-fadein')) {
				item.css({'opacity':0});
				item.animate({'opacity':1},{duration:600,queue:false});
			}
		}
		
		function resizeBackground(item) {
			
			var origImg = item.find('.tp-bg-img-intern');			
			var imgWidth = origImg.width();
			var imgHeight = origImg.height();
			
			// define image ratio
			var ratio = imgHeight/imgWidth;
			
			// get window sizes
			var winWidth = $(window).width() + 30;
			var winHeight = $(window).height();
			var winRatio = winHeight/winWidth;
			
			var newIWidth = 0;
			var newIHeight = 0;
			
			var newOWidth = 0;
			var newOHeight = 0;
			
			
			// resizing OutSide Fitting
			if (winRatio > ratio) {
				newOHeight = winHeight;
				newOWidth  = winHeight / ratio;
			} 
			else {
				newOWidth = winWidth;
				newOHeight = winWidth * ratio;				
			}
			
			// resizing InSide Fitting
			if (winRatio < ratio) {
				newIHeight = winHeight;
				newIWidth  = winHeight / ratio;
			} 
			else {
				newIWidth = winWidth;
				newIHeight = winWidth * ratio;				
			}
			
			
			// Inside Fitting
			if (item.hasClass('bg-fit-inside'))	{
				origImg.css({'width':newIWidth,	'height':newIHeight}); 
			} else {
			
					// OutSide Fitting
					if (item.hasClass('bg-fit-outside')) {
						
						origImg.css({'width':newOWidth,	'height':newOHeight});		    
					} else {
					
							// Stretch																		
							if (item.hasClass('bg-stretch')) {
								origImg.css({'width':$(window).width(),'height':$(window).height()});
							} else {
									// tiled																		
									if (item.hasClass('bg-tiled')) {
										  
										item.css({'width':($(window).width()+30)+"px",'height':$(window).height()});
										origImg.css({'width':($(window).width()+30)+"px",'height':$(window).height()});
									}
							}
					}
			}
		}	// END OF FUNCTION
	



//- END THE PLUGIN FROM HERE !!	
	}})
	
})(jQuery);			

				
			

			   