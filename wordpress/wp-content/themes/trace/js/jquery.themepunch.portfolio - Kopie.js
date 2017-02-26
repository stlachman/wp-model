/*******************************************************************************
 * jquery.themepunch.Banner.js - jQuery Plugin for Simple Slides Plugin
 * @version: 1.0 (10.01.2012)
 * @requires jQuery v1.2.2 or later 
 * @author Krisztian Horvath
********************************************************************************/




(function($,undefined){	
	
	
	
	////////////////////////////
	// THE PLUGIN STARTS HERE //
	////////////////////////////
	
	$.fn.extend({
	
		
		// OUR PLUGIN HERE :)
		tpportfolio: function(options) {
	
		
			
		////////////////////////////////
		// SET DEFAULT VALUES OF ITEM //
		////////////////////////////////
		var defaults = {	
			speed:500,
			row:2,
			nonSelectedAlpha:0,
			portfolioContainer:".portfolio"
		};
		
			options = $.extend({}, $.fn.tpportfolio.defaults, options);
		

			return this.each(function() {
				var opt=options;
				var main = $('body').find(opt.portfolioContainer);
				initItems(main,opt);
				arrangeFilters(main,opt);
			});
		
		}
	});
			
			//////////////////////
			// ARRANGE FILTERS	//
			//////////////////////
			function arrangeFilters(main,opt) {
			
				var bod=$('body');
				// SET UP THE CLICKS AND THE ANIMATIONS
				bod.find('.portfolio_selector').each(function(){
				
					// PREPARE THE FIRST START HERE
					var selector=$(this);
					if (selector.data('group') === "all-group") {
						selector.addClass('selected_selector');
					} else {
						selector.animate({'opacity':0.25},{duration:opt.speed,queue:false});
					}
					
					
					// HOVER EFFECT
					selector.hover(
						function() {
							var sels=$(this);
							sels.stop();
							sels.animate({'opacity':1},{duration:opt.speed,queue:false});
						},
						function() {
							var sels=$(this);
							if (!(sels.hasClass('selected_selector'))) {
								sels.stop();
								sels.animate({'opacity':0.25},{duration:opt.speed,queue:false});
							}
						});
						
						
						
					// CLICK EFFECT
					selector.click(function() { 						
								
								if (!main.hasClass("zoomanimated")) {
										var selector=$(this);
										// ADD AND REMOVE THE FADES FROM THE SELECTORS !!																
										// FIRST REMOVE THE SELECTED SELECTORS
										bod.find('.portfolio_selector').each(function(){ 
											var sels=$(this);
											sels.removeClass('selected_selector');
										});
										
										// THAN ADD THE SELECTED SELECTOR TO THE NEW ONE
										selector.addClass("selected_selector");
										opt.filter=selector.data('group');
										
										// THAN FADE OUT ALL NOT NEEDED SELECTOR
										bod.find('.portfolio_selector').each(function(){
											var sels=$(this);
											sels.stop();
											if (sels.hasClass('selected_selector')) {
												sels.animate({'opacity':1},{duration:opt.speed,queue:false});
											} else {
												sels.animate({'opacity':0.25},{duration:opt.speed,queue:false});
											}
										});
										
										
										if (opt.nonSelectedAlpha==0) {
											allItemZoomOut(main,opt);
											
											setTimeout(function() {
												removeInactives(main,opt);
												allItemZoomIn(main,opt);
											},500);
											
											setTimeout(function() {
												main.removeClass('zoomanimated');
											},700);
										}
								}
								
								return false;
					
					});
				});
			}
			
			
			
			
			///////////////////////////
			// REMOVE NOT USED ITEMS //
			//////////////////////////
			function removeInactives(main,opt) {
				var st=0;
				main.find('.killerclear').remove();				
				main.find('.eight.columns, .four.columns').each(function() {
					var div=$(this);
					div.removeClass('alpha').removeClass('omega');
					
					
					if (div.hasClass(opt.filter)) {
						
						div.css({'display':'block'});
						if (st==0) {
							div.addClass('alpha');
						} else {
							if (st==opt.row-1) {
								div.addClass('omega');
								div.after('<div class="killerclear" style="clear:both"></div>');
							}
						}
						
						st=st+1;
						if (st==opt.row)  st=0;
						
						
					} else {
					
						div.css({'display':'none'});
					}
				});
				
				
			}
			
			////////////////////////
			// ALL ITEM ZOOM OUT //
			//////////////////////
			function allItemZoomOut(main,opt) {
				main.addClass('zoomanimated');
				main.find('a').each(
						function(i) {				
							
							var a = jQuery(this);
							a.addClass("zoomanimon");
							var item=a.parent();
							var img = item.find('img');
							var src = img.attr('src');
							var w = item.outerWidth()-10;							
							var h = item.outerHeight()-10;								
														
							// CLEAR THE REMOVEMENT IF THERE IS ANY ALREADY
							clearTimeout(item.data('timeout'));
							
							// IF THERE IS NO IMAGE YET, WE NEED TO ADD IT
							a.find('.himage').remove();
							a.append('<div class="himage" style="overflow:hidden;position:absolute;top:4px;left:4px;width:'+(w)+'px;height:'+(h)+'px;"><img class="newimg" style="position:absolute;width:'+w+'px;height:'+h+'px" src="'+src+'"></div>');
																			
							// CATCH THE ITEMS WE NEED
							var newimg = item.find('.newimg');							
							
							
							// STOP ANIMATION IF THERE IS ANY
							newimg.stop(true,true);							
							
							img.css({'opacity':0});
							newimg.css({'top':'0px', 'left':'0px'});
							// ANIMATE THE ITEM HERE
							newimg.cssAnimate({'top':(h/3)+"px",'left':(w/3)+"px",'width':(w/4)+'px','height':(h/4)+"px"},{duration:500,queue:false});
							a.parent().cssAnimate({'opacity':0},{duration:500,queue:false});
						});
													
			};
			
			
			////////////////////////
			// ALL ITEM ZOOM OUT //
			//////////////////////
			function allItemZoomIn(main,opt) {
				main.find('a').each(
						function(i) {				
							
							var a = jQuery(this);
							var item=a.parent();
							var img = item.find('img');
							if (item.parent().css('display')=="block") {
									
									var src = img.attr('src');
									var w = item.outerWidth()-10;							
									var h = item.outerHeight()-10;								
									
									
									
									// IF THERE IS NO IMAGE YET, WE NEED TO ADD IT
									a.find('.himage').remove();
									a.append('<div class="himage" style="overflow:hidden;position:absolute;top:4px;left:4px;width:'+(w)+'px;height:'+(h)+'px;"><img class="newimg" style="position:absolute;width:'+w+'px;height:'+h+'px" src="'+src+'"></div>');
								
									// CATCH THE ITEMS WE NEED
									var newimg = item.find('.newimg');														
									
									// STOP ANIMATION IF THERE IS ANY
									newimg.stop(true,true);														
									newimg.css({'top':(h/3)+'px', 'left':(w/3)+'px', 'width':(w/4)+"px",'height':(h/4)+"px",'opacity':1});
									// ANIMATE THE ITEM HERE
									newimg.cssAnimate({'top':"0px",'left':"0px",'width':(w)+'px','height':(h)+"px"},{duration:300,queue:false});
									setTimeout(function() {
										img.css({'opacity':1});
										a.find('.himage').remove();
										a.removeClass("zoomanimon");
									},500);
									a.parent().cssAnimate({'opacity':1},{duration:300,queue:false});
							} else {
								img.css({'opacity':1});
								a.find('.himage').remove();
							}
						});
													
			};
			
			
			/////////////////////
			//	INIT THE ITEMS //
			////////////////////
			function initItems(main,opt) {
				var st=0;
				main.find('.eight.columns, .four.columns').each(function() {
					var div=$(this);
					
					div.css({'display':'block'});
						if (st==0) {
							div.addClass('alpha');
						} else {
							if (st==opt.row-1) {
								div.addClass('omega');
								div.after('<div class="killerclear" style="clear:both"></div>');
							}
						}
						
					st=st+1;
					if (st==opt.row)  st=0;
					
				});
			}
		
})(jQuery);			


			   