/**
 * jquery.freshline.lightbox - jQuery Plugin for lightbox gallery 
 * @version: 1.0 (22.11.11)
 * @requires jQuery v1.2.2 or later 
 * @author themepunch
 * All Rights Reserved, use only in freshline Templates or when Plugin bought at Envato ! 
**/






(function($,undefined){	
	
	
	
	//////////////////////////////////////
	// THE LIGHTBOX PLUGIN STARTS HERE //
	/////////////////////////////////////
	
	$.fn.extend({
	
		
		// OUR PLUGIN HERE :)
		tplightboxsolo: function(options) {
	
		
			
		////////////////////////////////
		// SET DEFAULT VALUES OF ITEM //
		////////////////////////////////
		var defaults = {	
			
			style:"dark-lightbox",			
			showGoogle:"yes",
			showFB:"yes",
			showTwitter:"yes",
			urlDivider:"?",
			vimeo_markup: '<iframe src="{path}?title=0&amp;byline=0&amp;portrait=0" width="{width}" height="{height}" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>',					
			youtube_markup:'<iframe src="{path}?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0" height="{height}" width="{width}" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>',
			flvmarkup:'<a href="{path}" style="display:block;width:{width};height:{height}"> </a>',
			flvplayer:"'.$template_uri_shortcodes.'/js/flowplayer_plugins/flowplayer-3.2.7.swf"
			
			
		};
		
		options = $.extend({}, $.fn.tplightboxsolo.defaults, options);
		

		return this.each(function(i) {				
			
			var opt=options;			
			var item=$(this);	
						
			setRollOver(item,opt);
			
			if (!item.data('link') == true) item.click(function() {return false});			
			
			// COLLECT ALL ITEMS IN THE SAME GROUPS
			var list=[];
			if ($('body').data(item.data('rel')) == undefined) $('body').data(item.data('rel'),list);
			
			
			if (item.data('rel')==undefined) item.data('rel',"nogroup");
			if (item.data('rel')!=undefined) {
				
				list = $('body').data(item.data('rel'));
				if (list==undefined) list=[];
				list.push(item);
				item.data('id',list.length-1);
				$('body').data(item.data('rel'),list);
			}
		})
		
		
				
		
		////////////////////////////////////////////////////////////
		// SET THE ROLL OVER AND ROLL OUT FUNCTIONS ON THUMBNAILS //
		////////////////////////////////////////////////////////////
		function setRollOver(item,opt) {
		
		
			item.data('opt',opt);
			item.find('.hover_plus').live('click',function() {
				startLightBoxSolo(item,item.data('opt'));								
			});
			
				
		}
			
			
		
		//////////////////////		
		// SET THE LI ITEMS //
		/////////////////////
		function checkMobile() {
			if( navigator.userAgent.match(/Android/i) ||
			 navigator.userAgent.match(/webOS/i) ||
			 navigator.userAgent.match(/iPhone/i) ||
			 navigator.userAgent.match(/iPod/i) ||
			 navigator.userAgent.match(/BlackBerry/)
			 ){
			 return true;
			} else {
				return false;
			}

		}
		
		function checkiPhone() {
						var iPhone=((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)));
						return iPhone;
					}

		function checkiPad() {
			var iPad=navigator.userAgent.match(/iPad/i);
			return iPad;
		}
					

					
					
		///////////////////////////
		// GET THE URL PARAMETER //
		///////////////////////////
		function getParameters(from,hashdivider)
				{
					var vars = [], hash;
					var hashes = from.slice(from.indexOf(hashdivider) + 1).split("&");
					for(var i = 0; i < hashes.length; i++)
					{												
						hash = hashes[i].split('=');						
						vars.push(hash[0]);
						vars[hash[0]] = hash[1];
						
			
					}
					return vars;
				}
					
							
		/////////////////////////////////////////
		// START THE LIGHTBOX HERE AFTER CLICK //
		////////////////////////////////////////
		function addNewLightBoxItem(item,opt,direction) {
			
			//  MEDIA AND TYP
			var imgsrc = item.attr('rel')
			var imgtyp = item.find(opt.image).data('typ');
			
			
			// TRY TO READ OUT THE PARAMETERS FROM THE HREF
			var urlsrc=getParameters(imgsrc,"&amp;")[0]
			var iframewidth=getParameters(imgsrc,"&amp;")["width"];
			var iframeheight=getParameters(imgsrc,"&amp;")["height"];
			
			
			
			// ADD THE RIGHT MEDIA TO THE LIGHTBOX
			$('body').append('<div id="tp-lightboxactitem" class="'+opt.style+' lightboxitem"></div>');
			
			// ADD THE IMAGE TO THE HOLDER
			var lboxitem = $('body').find('#tp-lightboxactitem');

			
			
			//CHECK IF VIDEO OR IMAGE 
			if (iframewidth!=undefined) {
				var ww= iframewidth;
				var hh= iframeheight
				var flvvideo=0;
				var flvid="";
				if (urlsrc.indexOf("youtube")>0)
					var videosrc=opt.youtube_markup.replace('{path}',urlsrc);
				else
					if (urlsrc.indexOf("vimeo")>0)
						var videosrc=opt.vimeo_markup.replace('{path}',urlsrc);
					else {
							
							var videosrc=opt.flvmarkup.replace('{path}',urlsrc);
							flvid="flv-"+Math.floor(Math.random()*999999);
							videosrc=videosrc.replace('{id}',flvid);							
							flvvideo=1;
						}
						
						//flvmarkup:'<a href="flvsrc" style="display:block;width:{width};height:{height}"> </a>'
						//flvplayer:"'.$template_uri_shortcodes.'/js/flowplayer_plugins/flowplayer-3.2.7.swf"
						//flowplayer("flvIDdesObjektes", "'.$template_uri_shortcodes.'/js/flowplayer_plugins/flowplayer-3.2.7.swf");
					
				videosrc=videosrc.replace('{width}',iframewidth);
				videosrc=videosrc.replace('{height}',iframeheight);
				lboxitem.append('<div class="tp-mainimage" style="width:'+ww+'px;height:'+hh+'px">'+videosrc+'</div>');
				if (flvvideo==1) {
					flowplayer(flvid, opt.flvplayer,{clip: {autoPlay: false, autoBuffering: true}});
				}
			 } else {
				lboxitem.append('<div><img class="tp-mainimage" src="'+imgsrc+'"></div>');
			}
			
			lboxitem.css({'display':'none'});
							
			
			// ADD AN INFOFIELD TO THE LIGHTBOX
			lboxitem.append('<div class="'+opt.style+' infofield"></div>');
			var infofield=lboxitem.find('.infofield');
			
			//ADD THE TITLE TO THE HOLDER
			infofield.append('<div class="'+opt.style+' title">'+item.data('title')+'</div>');
									
			var loader = $('body').find('#tp-lightboxloader');
			var list=$('body').data(item.data('rel'));


			var actEntryNr=item.data('id');		
			
			var maxEntry=list.length;
			
			lboxitem.data('opt',opt);			
			lboxitem.data('id',actEntryNr);
			lboxitem.data('rel',item.data('rel'));
			
			// ADD THE PAGE TEXT TO THE LIGHTBOX
			pagetext = (actEntryNr+1)+"/"+maxEntry;				
												
			// ADD THE N PAGE OF M PAGES DIV			
			infofield.append('<div class="'+opt.style+' rightbutton"></div>');
			infofield.append('<div class="'+opt.style+' pageofformat">'+pagetext+'</div>');
			infofield.append('<div class="'+opt.style+' leftbutton"></div>');
			
			
			
			
			//ADD THE Description TO THE HOLDER
			if (item.data('desc').length>0 && item.data('desc') !=undefined)
				infofield.append('<div class="'+opt.style+' description">'+item.data('desc')+'</div>');
			
			/////////////////////////////
			//	THE DEEP LINK FUNCTION //
			/////////////////////////////
						
			var urllink=document.URL; //+opt.urlDivider+"_id="+actEntryNr;
			
			// ADD THE SOCIAL ICONS
			var twit=$('<div class="twitter"><div class="social_tab"><a href="http://twitter.com/share" class="twitter-share-button" data-url="'+urllink+'" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div></div>');											
			var face=$('<div class="facebook"><div class="social_tab"><iframe src="//www.facebook.com/plugins/like.php?href='+urllink+'&amp;send=false&amp;layout=button_count&amp;width=250&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:21px;" allowTransparency="true"></iframe></div></div>');			
			var gplus=$('<div class="googleplus"><!-- +1 Button from plus.google.com --><div class="social_tab"><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><g:plusone size="medium" href="'+urllink+'"></g:plusone></div></div>');

			
			infofield.append('<div class="'+opt.style+' lightboxsocials"></div>');
			
			var soc=infofield.find('.lightboxsocials');
			soc.css({'opacity':'0.0'});
			soc.data('opt',opt);
			
			if (opt.showTwitter=="yes") {	
				soc.data('twit',twit);
				soc.append('<div class="twitter fakesoc"></div>');
			}
			if (opt.showFB=="yes") {
				soc.data('face',face);
				soc.append('<div class="twitter fakesoc"></div>');
			}
			if (opt.showGoogle=="yes") {
				soc.data('gplus',gplus);
				soc.append('<div class="twitter fakesoc"></div>');
			}
		
			
			//ADD THE BUTTONS					
			lboxitem.append('<div class="'+opt.style+' closebutton"></div>');
			
			var cbutton = lboxitem.find('.closebutton');
			var lbutton = infofield.find('.leftbutton');
			var rbutton = infofield.find('.rightbutton');
			
			cbutton.css({'opacity':'0.0'});
			
			cbutton.click(function() {
							removeLightBox();
							$('body').find('#tp-lightboxloader').remove();							
						});
						
														
			lbutton.click(
				function() {									
                    var item=$(this).parent().parent();
					var actEntry=item.data('id');		
					var opt=item.data('opt');					
					var list=$('body').data(item.data('rel'));					
					var maxEntry=list.length;
					var newEntry=actEntry-1;					
					if (newEntry<0) newEntry=maxEntry-1;
					
					var newitem=list[newEntry];
					
					lightBoxItemOut(2);					
					addNewLightBoxItem(newitem,opt,2);					
					
				});
			
			rbutton.click(
				function() {						
					 var item=$(this).parent().parent();
					var actEntry=item.data('id');		
					var opt=item.data('opt');					
					var list=$('body').data(item.data('rel'));					
					var maxEntry=list.length;
					var newEntry=actEntry+1;					
					if (newEntry==maxEntry) newEntry=0;
					
					var newitem=list[newEntry];
					
					lightBoxItemOut(1);					
					addNewLightBoxItem(newitem,opt,1);						
				});
			
			
			// TOUCH ENABLED SCROLL
						
				lboxitem.swipe( {data:lboxitem, 
								swipeLeft:function() 
										{ 
											var lboxitem = $('body').find('#tp-lightboxactitem');
											lboxitem.find('.rightbutton').click();
											
										}, 
								swipeRight:function() 
										{
											var lboxitem = $('body').find('#tp-lightboxactitem');
											lboxitem.find('.leftbutton').click();
										}, 
							allowPageScroll:"auto"} );
									
									
			// WAIT TILL IMAGE IS LOADED, AND THAN SET POSITION, ANIMATION, ETC....
			lboxitem.waitForImages(function() {   		
					
					if (direction!=1 && direction!=2) direction=1;
					lightBoxItemIn(direction);
					
					lboxitem.addClass('tp-lightboxactitem-loaded');
				});
			$('body').find('#notimportant').remove();
		}
		
		
		
		////////////////////////////////
		// REMOVE LIGHTBOX FROM STAGE //
		////////////////////////////////
		function removeLightBox() {
						lightBoxItemOut(1);
						setTimeout(function() {
							$('body').find('#tp-lightboxoverlay').cssAnimate({'opacity':'0.0'},{duration:400,queue:false});
							$('body').find('#tp-lightboxloader').cssAnimate({'opacity':'0.0'},{duration:400,queue:false});							
						},200);
						setTimeout(function() {
							$('body').find('#tp-lightboxoverlay').remove();	
							$('body').find('#tp-lightboxloader').remove();							
							$('body').find('#tp-lightboxactitem').remove();
						},600);
						
		}
		
		
		//////////////////////////////////////
		// MOVE THE BIG IMAGE TO THE STAGE //
		//////////////////////////////////////
		function lightBoxItemIn(dir) {		// DIR 1:  <-      DIR2: ->   //
		
					var lboxitem = $('body').find('#tp-lightboxactitem');
					var loader = $('body').find('#tp-lightboxloader');
					var lbutton = lboxitem.find('.leftbutton');
					var rbutton = lboxitem.find('.rightbutton');
					var soc=lboxitem.find('.lightboxsocials');
					
					clearTimeout(loader.data('anim'));
					loader.cssAnimate({'top':(($(window).height()/2)-60)+'px','opacity':'0.0'},{duration:200,queue:false});
					
					setTimeout(function() {
							var opt=soc.data('opt');
							if (opt.showTwitter=="yes") soc.append(soc.data('twit'));
							if (opt.showFB=="yes") soc.append(soc.data('face'));
							if (opt.showGoogle=="yes") soc.append(soc.data('gplus'));
							soc.find('.fakesoc').remove();
							soc.css({'display':'block','opacity':'0.0'});
							setTimeout(function() {soc.cssAnimate({'opacity':'1.0'},{duration:400,queue:false})},500);
					},1300);
					
					// LIGHTBOX PROBLEM FOR iPAD && iPhone
					var ts=0;
					if (checkMobile()) ts=jQuery(window).scrollTop();
					
					
					if (ts==0) 
						lboxitem.css({
								'top':ts+'px',
								'left':(60+$(window).width())+'px',
								'display':'block'
								});
					else
						lboxitem.css({
								'top':'50px',
								'left':(60+$(window).width())+'px',
								'display':'block'
								});
					
					
					var imgg = lboxitem.find('.tp-mainimage');
					
					var thisw = imgg.width();
					var imgh = imgg.height();
					
					imgg.data('orgw',thisw);
					imgg.data('orgh',imgh);
					
					var thish = lboxitem.height();
					
					var win=$(window);
					if (imgg.width() > win.width() || imgg.data('orgw')>win.width() || (imgg.width()<imgg.data('orgw') && imgg.width()<win.width())) {
							
						var newW = (win.width()-20);
						if (newW>imgg.data('orgw')) newW = imgg.data('orgw');
						imgg.width(newW);
						lboxitem.width(newW);
						lboxitem.css({'height':'auto'});
						var thisw = imgg.width();
						var thish = lboxitem.height();
						lboxitem.find('iframe').css({'width':newW+"px", 'height':(newW*0.5625)+"px"});
					}
					
					
					// SET THE RIGHT START POSITION
					if (dir==2) lboxitem.css({'left':(-30-thisw)+'px','top':'0px'});
					
					
					lboxitem.css({'width':thisw+"px"});
					if (ts==0)
						lboxitem.css({'top':($(window).height()/2 - thish/2)+'px'});
					else
						lboxitem.css({'top':'50px'});
						
					var img = lboxitem.find('.tp-mainimage')									
					img.animate({'opacity':'toggle'},0);
					lboxitem.find('.infofield').animate({'opacity':'toggle'},0);					
					lboxitem.find('.closebutton').animate({'opacity':'toggle'},0);
					
					setTimeout(
						function() {
							if (ts==0)
								lboxitem.css({'top':ts+($(window).height()/2 - thish/2)+'px'});																					
							else
								lboxitem.css({'top':'50px'});																					
							
							if (ts==0) {
									lboxitem.css({'width':'0px',
												  'height':'0px',
												  'left':(-5+$(window).width()/2)+'px', 
												  'top':($(window).height()/2)+'px'
												 });
									lboxitem.cssAnimate({'left':(-5+$(window).width()/2 - thisw/2)+'px', 
												 'top':ts+($(window).height()/2 - thish/2)+'px',
												 'width':thisw+"px",
												 'height':thish+"px"
												 },{duration:500,queue:false});
							} else {
									lboxitem.css({'width':'0px',
												  'height':'0px',
												  'left':(-5+$(window).width()/2)+'px', 
												  'top':'50px'
												 });
									lboxitem.cssAnimate({'left':(-5+$(window).width()/2 - thisw/2)+'px', 
												 'top':'50px',
												 'width':thisw+"px",
												 'height':thish+"px"
												 },{duration:500,queue:false});
							}
										 							
							
												 
							setTimeout(function() {
								img.animate({'opacity':'toggle'},0);
								lboxitem.find('.infofield').animate({'opacity':'toggle'},0);					
								lboxitem.find('.closebutton').animate({'opacity':'toggle'},0);
								
								
								
								
							},500);
							
							// Turn On Close Button Functions...
							lboxitem.hover(
								function() {
									var $this=$(this);
									$this.find('.closebutton').cssAnimate({'opacity':'1.0'},{duration:100,queue:false});
								}, 
								function() {
									var $this=$(this);
									$this.find('.closebutton').cssAnimate({'opacity':'0.0'},{duration:100,queue:false});
								});
							
						},600);
		}
		
		
		
		
		//////////////////////////////////////////
		// MOVE THE BIG IMAGE OUT OF THE STAGE //
		/////////////////////////////////////////
		function lightBoxItemOut(dir) {		// DIR 1:  <-      DIR2: ->   //
					
					var lboxitem = $('body').find('#tp-lightboxactitem');
					var loader = $('body').find('#tp-lightboxloader');
					var lbutton = lboxitem.find('.leftbutton');
					var rbutton = lboxitem.find('.rightbutton');
					
					lboxitem.attr('id',"tp-lightbox-OLD-item");
					
					var img = lboxitem.find('.tp-mainimage')					
					
					var thisw = lboxitem.find('.tp-mainimage').width();
					
					var ll=lboxitem.offset().left;
					var tt=lboxitem.offset().top;
					var ww=lboxitem.outerWidth();
					var hh=lboxitem.outerHeight();
					
					lboxitem.width(ww);
					lboxitem.height(hh);
							
					
					img.animate({'opacity':'toggle'},10);
					lboxitem.find('.infofield').animate({'opacity':'toggle'},10);					
					lboxitem.find('.closebutton').animate({'opacity':'toggle'},10);
					
					
					
					
					
					
					loader.data('anim',setTimeout(function() {loader.cssAnimate({'top':(($(window).height()/2))+'px','opacity':'1.0'},{duration:200,queue:false});},400));									
					if (dir==1) {
						setTimeout(function() {
							
						
							lboxitem.cssAnimate({'left':-5+$(window).width()/2+'px',
												 'top':$(window).height()/2+'px',
												 'width':"0px",
												 'height':"0px"
												 
												 },{duration:200,queue:false});							
						},150);
					} else {
						setTimeout(function() {
							
						
							lboxitem.cssAnimate({'left':-5+(ll+ww/2)+'px',
												 'top':(tt+hh/2)+'px',
												 'width':"0px",
												 'height':"0px"
												 
												 },{duration:200,queue:false});							
						},20);				
					}
					
					setTimeout(function() {lboxitem.remove()},350);
		}
		
		
		
		/////////////////////////////////////////
		// START THE LIGHTBOX HERE AFTER CLICK //
		////////////////////////////////////////
		function startLightBoxSolo(item,opt) {
						
						// ADD A BIG OVERLAY ON THE SCREEN
					    
						
						$('body').append('<div id="tp-lightboxoverlay" class="'+opt.style+' overlay"></div>');
						var overlay=$('body').find('#tp-lightboxoverlay');
						
						var targetOpacity = overlay.css('opacity');
						
						// LIGHTBOX PROBLEM FOR iPAD && iPhone
						var ts=0;
						if (checkMobile()) ts=jQuery(window).scrollTop();
						
						overlay.css({	
										'width':$(window).width()+'px',
										'height':($(window).height()+150)+'px',
										'opacity':'0.4',
										'top':'0px',
										'left':'0px'
										});																	

						overlay.cssAnimate({'opacity':targetOpacity},{duration:500,queue:false});
						
						$('body').append('<div id="tp-lightboxloader" class="'+opt.style+' loader"></div>');
						var loader=$('body').find('#tp-lightboxloader');
						loader.css({
										'top':(ts+$(window).height()/2)+'px',
										'left':$(window).width()/2+'px'});
						
						
						addNewLightBoxItem(item,opt);
						
						overlay.click(function() {
							removeLightBox();
						});
						
						/////////////////////////////////////////////////////////////////////////////////////
						// DEPENDING ON THE SCROLL OR RESIZING EFFECT, WE SHOULD REPOSITION THE LIGHTBOX  //
						/////////////////////////////////////////////////////////////////////////////////////
						$(window).bind('resize scroll', resizeMeNow);						
		}
		
		
		
				/////////////////////////////////////////////////////
				// RESIZE THE WINDOW, AND OPEN THE MAIN IMAGE HERE //
				/////////////////////////////////////////////////////
				function resizeMeNow(dontshowinfo) {
						
						var $this=$(window);							
						var overlay=$('body').find('#tp-lightboxoverlay');
						
						
						// LIGHTBOX PROBLEM FOR iPAD && iPhone
						var ts=0;
						if (checkMobile()) ts=jQuery(window).scrollTop();
						
						ts=0;
							
						
						overlay.css({'width':$this.width()+'px',
									'height':($this.height()+150)+'px',
									'top':ts+'px'
									});
						
						// SET THE LOADER POSITION IN THE RIGHT POSITION
						var loader=$('body').find('#tp-lightboxloader');
						loader.css({
										'top':(ts+$(window).height()/2)+'px',
										'left':$(window).width()/2+'px'});
						
						// SET THE ACTUAL SHOWN MAIN ITEM POSITION
						var lboxitem = $('body').find('.tp-lightboxactitem-loaded');											
						var img = lboxitem.find('.tp-mainimage');	
						
						var thisw=lboxitem.width();
						var thish=lboxitem.height();						
						
						lboxitem.stop();
						if (img!=undefined) {
									
									/*if (img.width() > $this.width() || img.data('orgw')>$this.width() || (img.width()<img.data('orgw') && img.width()<$this.width())) {
										var newW = ($this.width()-20);
										console.log(newW+"  "+img.data('orgw'));
										if (newW>img.data('orgw')) newW=img.data('orgw');
										img.css({width:(newW)+"px"});
										lboxitem.find('iframe').css({'width':newW+"px", 'height':(newW*0.5625)+"px"});
										lboxitem.css({width:'auto',height:'auto'});																			
									}*/										
										lboxitem.animate({'left':(-5 + $(window).width()/2 - thisw/2)+'px', 'top':ts+ ($(window).height()/2 - thish/2)+'px' },{duration:100,queue:false});
						}					
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
					
		
			
						
		
		
	}
})



	
	
	
	
	
	
	
		
				
})(jQuery);			

				
			

			   