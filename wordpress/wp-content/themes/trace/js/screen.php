jQuery.noConflict();
jQuery.fn.css = jQuery.fn.cssOriginal;
/* #On Document Ready
================================================== */
/*
 Color animation jQuery-plugin
 http://www.bitstorm.org/jquery/color-animation/
 Copyright 2011 Edwin Martin <edwin@bitstorm.org>
 Released under the MIT and GPL licenses.
*/
(function(d){function i(){var b=d("script:first"),a=b.css("color"),c=false;if(/^rgba/.test(a))c=true;else try{c=a!=b.css("color","rgba(0, 0, 0, 0.5)").css("color");b.css("color",a)}catch(e){}return c}function g(b,a,c){var e="rgb"+(d.support.rgba?"a":"")+"("+parseInt(b[0]+c*(a[0]-b[0]),10)+","+parseInt(b[1]+c*(a[1]-b[1]),10)+","+parseInt(b[2]+c*(a[2]-b[2]),10);if(d.support.rgba)e+=","+(b&&a?parseFloat(b[3]+c*(a[3]-b[3])):1);e+=")";return e}function f(b){var a,c;if(a=/#([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})/.exec(b))c=
[parseInt(a[1],16),parseInt(a[2],16),parseInt(a[3],16),1];else if(a=/#([0-9a-fA-F])([0-9a-fA-F])([0-9a-fA-F])/.exec(b))c=[parseInt(a[1],16)*17,parseInt(a[2],16)*17,parseInt(a[3],16)*17,1];else if(a=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(b))c=[parseInt(a[1]),parseInt(a[2]),parseInt(a[3]),1];else if(a=/rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9\.]*)\s*\)/.exec(b))c=[parseInt(a[1],10),parseInt(a[2],10),parseInt(a[3],10),parseFloat(a[4])];return c}
d.extend(true,d,{support:{rgba:i()}});var h=["color","backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","outlineColor"];d.each(h,function(b,a){d.fx.step[a]=function(c){if(!c.init){c.a=f(d(c.elem).css(a));c.end=f(c.end);c.init=true}c.elem.style[a]=g(c.a,c.end,c.pos)}});d.fx.step.borderColor=function(b){if(!b.init)b.end=f(b.end);var a=h.slice(2,6);d.each(a,function(c,e){b.init||(b[e]={a:f(d(b.elem).css(e))});b.elem.style[e]=g(b[e].a,b.end,b.pos)});b.init=true}})(jQuery);


jQuery(document).ready(function() {	

	 jQuery(".scalevid").fitVids();

	/* Remove Tag class from Body*/
	jQuery("body").removeClass("tag");
		
	
	
	/*	INIT THE RESPONSIVE MENU HANDLING */
	menuHandler();
	
	
	/*	NAVIGATION INITALISATION  */
	initNav();
	
		
	/*	INIT SEARCH FIELD */
	initSearchField();
	
	/*	INIT THE SITEMAP ACCORDIONS */
	initSiteMaps();
	

	/*	INIT LIGHTBOX	**/
	initLightboxPlugin();
	
	 /* CHECK TEASER */
	 checkTeaserNav();

	/*	INIT THE SOCIAL BUTTONS	*/
	initSocial();
	
	/*	TEASER ROTATOR INIT	*/
	initTeaserRotator();
	
	/*	ACCORDION INIT	*/
	initAccordion();
	
	/*	TESTIMONIALS  */
	initTestimonials();
	
	/* FADE LISTS */
	listfades();

	/* CALL AUDIO,VIDEO HTML5 PLAYER */
	initAudio();
	
	<?php 
			if ( function_exists( 'get_option_tree') ) {
				if(get_option_tree( 'aversis_footer_active' )) $aversis_footer_active="on"; else $aversis_footer_active="off";
			} else { $aversis_footer_active="on"; }
		if($aversis_footer_active!="off"){?>
	/* CALL FOOTERHANDLING */
	footerHandler();
		<?php } ?>
	/*	TABS INIT  */
	tabsInit();
	
	jQuery(".blog_subinfos").each(function(){
		jQuery(this).find(".blog_subinfos_divider:last").remove();
	});
	
	/* Responsive Select Menu */
	jQuery("#responsive-menu select").change(function() {
		window.location = jQuery(this).find("option:selected").val();
	});
});

	
		function setColor(hex) {
				if (jQuery('#krikilink').length>0) {
						jQuery("#krikilink").remove();				
				} 
				jQuery("<link/>", {
					id : "krikilink",
					rel: "stylesheet",
					type: "text/css",
					href: "http://www.themepunch.com/averis/wp-content/themes/averis/css/screen.php?maincolor="+hex
				}).appendTo("head");
				

				jQuery('#packme').css({'backgroundColor':'#'+hex});
		}
		
		
		function checkTeaserNav(){
			jQuery(".teaser_ul").each(function(){
				$this = jQuery(this);
				if($this.find("li").length<=$this.data("elements")) 
					jQuery($this).parent().parent().find(".tp_teaser_navigation").hide();
			});

			jQuery(".sidebar .widget_divide:last").remove();
		}

		//////////////////////
		//	INIT ACCORDION	//
		/////////////////////
		function initAccordion() {
			jQuery('.accordion-item').each(function(i) {
				var item=jQuery(this);
				item.find('.togglecontent').slideUp(0);
				item.find('.accordion_down, .accordionopen').click(function() {
					var displ = item.find('.togglecontent').css('display');
					item.closest('ul').find('.toggleswitch').each(function() {
						var li = jQuery(this).closest('li');
						li.find('.togglecontent').slideUp(300);
						li.find('.toggleswitch').removeClass("selected");
						li.removeClass('highlight');
					});
					if (displ=="block") {
						item.find('.togglecontent').slideUp(300) 
						item.find('.toggleswitch').removeClass("selected");
						item.removeClass('highlight');
					} else {
						item.find('.togglecontent').slideDown(300) 
						item.find('.toggleswitch').addClass("selected");
						item.addClass('highlight');
					}
				});
			});
		}


		//////////////////////////////
		//	INIT THE TEASER ROTATOR	//
		//////////////////////////////
		function initTeaserRotator() {
			jQuery('.tp_teaser').each(function() {
				
				var item=jQuery(this);
				item.find('ul').addClass('listfade-img');
				
				var amount_per_page=4;
				if (item.hasClass('four_per_page')) 
					amount_per_page=4;
				 else
					if (item.hasClass('two_per_page')) 
						amount_per_page=2;
					else
						if (item.hasClass('three_per_page')) 
							amount_per_page=3;
				
				// SAVE SOME INFO ABOUT THE SLIDER
				item.data('maxentry',item.find('ul:first >li').length);				
				item.data('pos',0);
				item.data('step',item.find('ul:first >li:first').outerWidth(true));
				
				var ul = item.find('ul:first');
				var lbutton = item.find('.tp_teaser_left');
				var rbutton = item.find('.tp_teaser_right');
				
				var pos = item.data('pos');
						var maxentry = item.data('maxentry');						
						item.data('step',item.find('ul:first >li:first').outerWidth(true));
						var step = item.data('step');
						ul.stop();
						ul.cssAnimate({'left':(0-(pos*step))+"px"},{duration:300,queue:false});
				
				// IF WINDOW IS RESIZED, THEN SLIDES NEED TO BE MOVED INTO THE RIGHT POSITION
				jQuery(window).resize(function() {					
					clearTimeout(item.data('resized'));
					item.data('resized',setTimeout(function() {
						var pos = item.data('pos');
						var maxentry = item.data('maxentry');						
						item.data('step',item.find('ul:first >li:first').outerWidth(true));
						var step = item.data('step');
						ul.stop();
						if (pos==maxentry-1) pos=pos-1;
						if (pos<0) pos=0;
						ul.cssAnimate({'left':(0-(pos*step))+"px"},{duration:300,queue:false});
						rbutton.removeClass('notinuse');
					},200));
					
				});
				
				lbutton.click(function() {
					
					var pos = item.data('pos');
					var maxentry = item.data('maxentry');
					var step = item.data('step');
					
					pos = pos - 1;
					if (pos<=0) {
						pos =0;
						lbutton.addClass('notinuse');
					}
					rbutton.removeClass('notinuse');
					item.data('pos',pos);
					
					ul.stop();
					ul.cssAnimate({'left':(0-(pos*step))+"px"},{duration:300,queue:false});
					
				});
				
				rbutton.click(function() {
					
					var pos = item.data('pos');
					var maxentry = item.data('maxentry');
					var step = item.data('step');
					
					pos = pos + 1;
					var napp = amount_per_page;
					if (jQuery(window).width()<462) napp = 1;
					
					
					if (pos>=maxentry-napp) {					
						pos=maxentry-napp;
						rbutton.addClass('notinuse');
					}
					lbutton.removeClass('notinuse');
					item.data('pos',pos);
					ul.stop();
					ul.cssAnimate({'left':(0-(pos*step))+"px"},{duration:300,queue:false});
				});
			});
		}
	
	
		////////////////////////////////
		// INITIALISATION OF LIGHTBOX //
		///////////////////////////////
		function initLightboxPlugin() {

			jQuery(".lightbox").each(function(){
				$image = jQuery(this);
				$a = $image.closest("a");
				$a.wrap('<div class="hovering_more">');
				$a.closest("div").wrap('<div class="hovering">');
				$a.html('<div class="pmore"></div>');
				$image.insertBefore($a.closest("div"));
			});

			jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({overlay_gallery: false,social_tools:false});	
		}

		
	

		///////////////////////
		// INIT SEARCH FIELD //
		//////////////////////
		function initSearchField() {
			// Check the Search value on Standard 
				jQuery(".reply-form .inputbox, #Form_Search, #commentfields .inputbox, #commentfields .InputBox, #commentfields .TextBox").each(function() {
					var field=jQuery(this);
					field.data('standard',field.val());
				});
				
				
				jQuery(".reply-form .inputbox, #Form_Search, #commentfields .inputbox,#commentfields .InputBox, #commentfields .TextBox").focus(function(){
					var $this = jQuery(this); 
					$this.val($this.val()== $this.data('standard') ? "" : $this.val());
				});
				jQuery(".reply-form .inputbox, #Form_Search, #commentfields .inputbox,#commentfields .InputBox, #commentfields .TextBox").blur(function(){
					var $this = jQuery(this); 
					$this.val($this.val()== "" ? $this.data('standard') : $this.val());
				});
		}

		


		//////////////////////////////				
		// NAVIGATION INITALISATION //
		//////////////////////////////
		function initNav() {
			
			var nav = jQuery('#nav');
			nav.find('ul li ul').each(function() {
				var li=jQuery(this).find('>li').last();				
				
			});
			
			nav.find('ul li ul').each(function(i) {
				
				var ul =jQuery(this);				
				
				ul.data('height',ul.height());
				ul.animate({'height':'0px'},{duration:230,queue:false});
				
				//ul.slideUp(0);
			});
			
			
					
			
			/*	NAVIGATION */
			nav.find(' li').each(function() {				
				
				jQuery(this).hover(
					function() {
						
						var ul=jQuery(this).find('ul:first');
						ul.stop();

						clearTimeout(ul.data('timeout'));
						clearTimeout(ul.data('timeout2'));												
						ul.css({'display':'block'});
						setTimeout(function() {
							var newh=0;
							ul.find('>li').each(function() {
								newh=newh+jQuery(this).outerHeight();
							});

							ul.data('height',newh);
							ul.stop();
							ul.animate({'height':ul.data('height')+"px",'opacity':1.0},{duration:180,queue:false});
						},50);
						ul.animate({'height':ul.data('height')+"px",'opacity':1.0},{duration:230,queue:false});
						
						
					},
					function() {
						var ul=jQuery(this).find('ul:first');						
						ul.stop();
						//li.delay(100).slideUp(230);
						//clearTimeout(li.data('timeout'));
						ul.data('timeout',setTimeout(function() {
							ul.animate({'height':"0px",'opacity':0},{duration:230,queue:false});
							ul.data('timeout2',setTimeout(function() {ul.css({'display':'none'})},230));
						},100));
						
						
						
					});
			});
		}

		
		
		
		
		
		
		

		
		
		/*********************/
		/*	Footer Handler	*/
		/********************/
		function footerHandler() {	
			jQuery('#content_container #content').append('<div class="sixteen columns"><div style="height:2px; width:100%;" id="footerjustify"></div></div>');
			
			
			jQuery(window).resize(function() {								
				organiseBgs();				
			});
			
			setInterval(function() {
				organiseBgs();					
			},100);
		}

		
		
		/**************************
			-	List Fade	-
		***************************/

			function listfades() {				
				 jQuery('.listfade').find('>li').each(function() {
				 	
				  var li=jQuery(this);
				  li.hover(function() {				
								var li=jQuery(this);        
								li.addClass('listover');
								li.find('img:first').addClass('listovereffect');							
								li.closest('ul').find('>li').each(function(i) {
									
										var lis = jQuery(this);
										lis.stop();
										if (!lis.hasClass('listover'))
											lis.animate({opacity:0.3},{duration:300,queue:false});
										else
											lis.animate({opacity:1},{duration:300,queue:false});
								}); 
							},
							function() {
										var li=jQuery(this);        
										li.removeClass('listover');
										li.find('img:first').removeClass('listovereffect');
										li.siblings().each(function() {
										 var lis = jQuery(this);
										 lis.stop();
										 lis.animate({opacity:1},{duration:300,queue:false});
										});
										
										li.stop();     
										li.animate({opacity:1},{duration:300,queue:false});
									   });
							});
							
							
				/* jQuery('.listfade-img').find('>li').each(function() {
				 	
				  var li=jQuery(this);
				  li.hover(function() {				
								var li=jQuery(this);        
								li.addClass('listover');
								li.find('img:first').addClass('listovereffect');							
								li.closest('ul').find('>li').each(function(i) {
									
										var lis = jQuery(this);
										lis.stop();
										if (!lis.hasClass('listover'))
											lis.find('img:first').animate({opacity:0.3},{duration:300,queue:false});
										else
											lis.find('img:first').animate({opacity:1},{duration:300,queue:false});
								}); 
							},
							function() {
										var li=jQuery(this);        
										li.removeClass('listover');
										li.find('img:first').removeClass('listovereffect');
										li.siblings().each(function() {
										 var lis = jQuery(this);
										 lis.stop();
										 lis.find('img:first').animate({opacity:1},{duration:300,queue:false});
										});
										
										li.stop();     
										lis.find('img:first').animate({opacity:1},{duration:300,queue:false});
									   });
							});
					*/
					
					
						
						
						
						
				jQuery('.listfade-img').find('>li, .covered').live('mouseenter',
					function() {
						
						var li=jQuery(this);
						var img=li.find('img');
						if (li.find('.cover').length==0)
							img.after('<div class="cover"></div>');						
						var cov = li.find('.cover');
						cov.width(img.width());
						cov.height(img.height());
						
						cov.addClass("selected");
					});
				jQuery('.listfade-img').find('>li, .covered').live('mouseleave',	
					function() {
						var li=jQuery(this);
						var img=li.find('img');
						var cov = li.find('.cover')
						cov.removeClass("selected");
					});
						
						

			}

		//////////////////////////////////////////////////////////
		// PUT THE FOOTER,CONTAINER ETC. IN THE RIGHT POSITION //
		/////////////////////////////////////////////////////////
		function organiseBgs() {

					var subfooterh = jQuery('#sub_footer').outerHeight();										
					jQuery('#footer').css({'paddingBottom':(subfooterh-6)+'px'});
					jQuery('#sub_footer').css({'margin-top':(-40-subfooterh)+"px"});
															
					var mainh = jQuery('#content_container').outerHeight();																														
					var footer = jQuery('#footer');
					var footerh = footer.outerHeight();
					var subfooterh = jQuery('#sub_footer').outerHeight();										
					var windowh = jQuery(window).height();							
					var fj = jQuery('#footerjustify');
					var fjh = fj.height();
					
					
					
					var dif = windowh - (footerh + 100 + subfooterh + mainh);
					
					if (jQuery('body').data('fjanimateon') != 1) {
						if (dif>0 && (dif-fjh)>1) {						
							
							jQuery('body').data('fjanimateon',1);
							fj.animate({'height':dif+"px"},{duration:600,queue:false,complete:function() {jQuery('body').data('fjanimateon',0);}});						
						} 
						
						if (dif<0) {
							
							fj.stop();
							jQuery('body').data('fjanimateon',1);
							fj.animate({'height':"0px"},{duration:600,queue:false,complete:function() {jQuery('body').data('fjanimateon',0);}});						
						}
					}
					
										
		}
		
		
		//////////////////
		// INIT TWITTER //
		//////////////////
		function initTwitter() {
			jQuery('#twitter_feed').twitterReader({
				user:'envato',
				count:3
			});	 
		}		
		
		//////////////////
		//	INITSOCIAL //
		/////////////////
		function initSocial() {
			var socwidth=0;
			var amount = jQuery('body').find('.socials li').length;
			jQuery('body').find('.socials li').each(function(i) {
				socwidth = socwidth + jQuery(this).width();
			});
			socwidth = socwidth + ((amount)*10)
			
			jQuery('body').find('.soc').each(function() {
				
				var tt=jQuery(this).find(' .tooltip');
				
				
				tt.css({'left':(-7-(tt.width()/2))+"px"});
				setTimeout(function() {
						
						tt.css({'left':(-7-(tt.width()/2))+"px"});
					},500);
				
				var tt = jQuery(this);			
				tt.hover(function() {
						var tt=jQuery(this).find(' .tooltip');
						tt.css({'left':(-7-(tt.width()/2))+"px"});
						
					},function() {});
			})
			
			
			var socials= jQuery('body').find('.socials');				
			socials.width(socwidth);
			
			
			
		}
		
		
		
		
		
		
			
				
			//////////////////////////
			//	MENU HANDLER  	    //
			//////////////////////////
			function menuHandler() {

				var defpar = jQuery('#nav').parents().length;

				
				/*jQuery('#nav ul >li >a').each(function() { 
						
						jQuery(this).text(jQuery(this).text().toUpperCase());
				});*/
				jQuery('#responsive-menu select option:first').remove();
				
				jQuery('#nav li >a').each(function() {
					var a=jQuery(this);
					var par= a.parents().length-defpar -3;				
					
					var natext = a.text();
					natext=natext.toLowerCase();
					natext = natext.charAt(0).toUpperCase() + natext.slice(1);
					//a.text(natext);
					
					if (par==0)
						var newtxt=jQuery("<div>"+natext+"</div>").text();
					else
						if (par==2)
							var newtxt=jQuery("<div>&nbsp;&nbsp;&nbsp;"+natext+"</div>").text();
						else
							if (par==4)
								var newtxt=jQuery("<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+natext+"</div>").text();
					
					 jQuery('#responsive-menu select').append(new Option(newtxt,a.attr('href')) );
				});
				

				
				var aktmenu=jQuery('.current_page_item a:first').text();
				
				aktmenu=aktmenu.toLowerCase();
				aktmenu = aktmenu.charAt(0).toUpperCase() + aktmenu.slice(1);
				jQuery('#responsive-menu-button').html(aktmenu);
				jQuery('#responsive-menu select option').each(function() {
					//alert(jQuery(this).text()+"  "+aktmenu);
					if (jQuery(this).text().toLowerCase() == aktmenu.toLowerCase()) {
						jQuery(this).data('selected','selected');						
						
					} else {
						jQuery(this).removeAttr('selected');
					} 
				});
				
				
				var deviceAgent = navigator.userAgent.toLowerCase();
				var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
				if (agentID) {		
					jQuery('#responsive-menu select').addClass('apple');	 					
				} 
			}

			
			
			
			
			//////////////////////////
			//	INIT THE SITEMAPS	//
			//////////////////////////
			function initSiteMaps() {
				
				var defpar = jQuery('#nav').parents().length;
					
				jQuery('#nav ul:first>li >a').each(function() {
					var a=jQuery(this);					
					var child = a.parent().find('ul').length;
					var newtxt=a.text().toLowerCase();
					newtxt = newtxt.charAt(0).toUpperCase() + newtxt.slice(1);
					
					jQuery('.sitemap').each(function(i) {
						
						var ul=jQuery(this);
						if (child>0)  {
							ul.append('<li class="accordion-item latestmapli"><div class="toggleswitch toggletitle"><a href="'+a.attr('href')+'">'+newtxt+'</a></div><div class="accordion_down"></div><div class="clear"></div><div class="togglecontent"></div><div class="contentdivider"></div></li>');
							var latest=ul.find('.latestmapli');
							latest.removeClass('latestmapli');
							latest = latest.find('.togglecontent');
							a.parent().find('ul:first>li >a').each(function() {
								var a2=jQuery(this);					
								var child = a2.parent().find('ul').length;
								var newtxt=a2.text().toLowerCase();
								newtxt = newtxt.charAt(0).toUpperCase() + newtxt.slice(1);
								
								latest.append('<div><a href="'+a2.attr("href")+'">'+newtxt+'</a></div>');
							});
							
						} else {
							ul.append('<li class="accordion-item"><div class="toggleswitch toggletitle"><a href="'+a.attr('href')+'">'+newtxt+'</a></div><div class="clear"></div><div class="togglecontent"><p>HALLO THERE</p></div><div class="contentdivider"></div></li>');
						}
					});
					
				});							
			}
			
			//////////////////////////////
			//	INIT THE TESTIMONIALS	//
			/////////////////////////////
			function initTestimonials() {
				jQuery('.tp_testimonials').each(function() {
					
					var test=jQuery(this);
					var ul=test.find('ul:first');
					var lbutton = test.find('.tp_testimonials_left');
					var rbutton = test.find('.tp_testimonials_right');
					pos=0;					
					var maxe = test.find('ul >li').length;					
					
					
					// IF WINDOW IS RESIZED, THEN SLIDES NEED TO BE MOVED INTO THE RIGHT POSITION
					jQuery(window).resize(function() {					
						clearTimeout(test.data('resized'));
						test.data('resized',setTimeout(function() {
							test.find('ul >li').each(function(i) {
								var li=jQuery(this);	
								if (i!=pos) {
									li.animate({'opacity':0});
								} else {
									li.animate({'opacity':1});
									ul.animate({'height':li.outerHeight()+"px"},{duration:300});
								}
							});
							
						},200));
						
					});
					
					
					test.find('ul >li').each(function(i) {
						var li=jQuery(this);	
						if (i!=0) {
							li.animate({'opacity':0});
						} else {
							li.animate({'opacity':1});
							ul.animate({'height':li.outerHeight()+"px"},{duration:300});
						}
						
					});
					
					lbutton.click(function() {
						
						pos=pos-1;
						if (pos<0) pos=maxe-1;
						test.find('ul >li').each(function(i) {
							var li=jQuery(this);							
							li.stop();
							if (i!=pos) {
								li.animate({'left':'400px','opacity':0},{duration:300});
							 } else { 							
								li.css({'left':'-400px','opacity':0});
								li.animate({'left':'0px','opacity':1},{duration:300});			
								ul.animate({'height':li.outerHeight()+"px"},{duration:300});
							}
						});
					});
					
					rbutton.click(function() {
						
						pos=pos+1;
						if (pos==maxe) pos=0;
						test.find('ul >li').each(function(i) {
							var li=jQuery(this);							
							li.stop();
							if (i!=pos) {
								li.animate({'left':'-400px','opacity':0},{duration:300});
							 } else { 							
								li.css({'left':'400px','opacity':0});
								li.animate({'left':'0px','opacity':1},{duration:300});			
								ul.animate({'height':li.outerHeight()+"px"},{duration:300});
							}
						});
					});
					
				});
			}

function initAudio(){
		jQuery('audio,video').mediaelementplayer({
				pluginPath: '<?php echo $_GET["dir"];?>/js/',
				// name of flash file
				flashName: 'flashmediaelement.swf',
				// name of silverlight file
				silverlightName: 'silverlightmediaelement.xap',
				success: function(player, node) {
					jQuery('#' + node.id + '-mode').html('mode: ' + player.pluginType);
				}
			});
}

/*
* Skeleton V1.1
* Copyright 2011, Dave Gamache
* www.getskeleton.com
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
* 8/17/2011
*/
jQuery('body').on('click', 'ul.tabs > li > a', function(e) {

    //Get Location of tab's content
    var contentLocation = $(this).attr('href');

    //Let go if not a hashed one
    if(contentLocation.charAt(0)=="#") {

        e.preventDefault();

        //Make Tab Active
        $(this).parent().siblings().children('a').removeClass('active');
        $(this).addClass('active');

        //Show Tab Content & add active class
        $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

    }
});


function tabsInit() {
 
 /*
 * Skeleton V1.1
 * Copyright 2011, Dave Gamache
 * www.getskeleton.com
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 8/17/2011
 */
 
 /* Tabs Activiation
 ================================================== */

 var tabs = jQuery('ul.tabs');

 tabs.each(function(i) {

  //Get all tabs
  var tab = jQuery(this).find('> li > a');
  tab.click(function(e) {

   //Get Location of tab's content
   var contentLocation = jQuery(this).attr('href');

   //Let go if not a hashed one
   if(contentLocation.charAt(0)=="#") {

    e.preventDefault();

    //Make Tab Active
    tab.removeClass('active');
    jQuery(this).addClass('active');

    //Show Tab Content & add active class
    jQuery(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

   }
  });
 }); 
}

jQuery(window).load(function(){
	(function(d, s, id) {
				if(jQuery(".fb-like").length)  {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=162252937201892";
				  fjs.parentNode.insertBefore(js, fjs);
				}  
	}(document, 'script', 'facebook-jssdk'));
});

// Toggle visibility between none and inline
function toggle_it(itemID){
		if (itemID == 'pr1')
		{
			document.getElementById('pr1').style.display = 'inline';		
			document.getElementById('pr2').style.display = 'none';		
		}

		if (itemID == 'pr2')
		{
			document.getElementById('pr2').style.display = 'inline';		
			document.getElementById('pr1').style.display = 'none';		
		}
	}