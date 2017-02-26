

jQuery(function() {
			
	
			// Start the Editor
				
				
				$slidecontainer = jQuery("#slides");
				$basic_slide = jQuery("#basic_slide_li .slide_li");
				$basic_caption = jQuery("#basic_caption_li .caption_li");
																
				jQuery('.slidetype').live("change",function() {
						
						var sel=jQuery(this);
						var $slide = sel.closest('.slide_li');						
						if (sel.find(':selected').val()!="Image") {
							$slide.find('.imagetype').hide(200);
							$slide.find('.videoclass').show(200);
							
						} 
						if (sel.find(':selected').val()=="Image") {
							$slide.find('.imagetype').show(200);
							$slide.find('.videoclass').hide(200);
						}
					
				});
				
			// Open/Close the slides..
				jQuery('.openclose').live("click",function() {
					if (jQuery(this).parent().find('.inside').length>0)
						jQuery(this).parent().find('.inside').slideToggle(500);
					else
						jQuery(this).parent().parent().find('.inside-caption').slideToggle(500);
						
						
					if (jQuery(this).hasClass('selected'))
						jQuery(this).removeClass('selected')
					else
						jQuery(this).addClass('selected')
				});
			
			// CHANGING WIDTH & HEIGHT....
				jQuery('#banner_width').change(function() {
					jQuery('body').find('.slideimageholder').each(function() {
							jQeury(this).height(350 / jQuery('#banner_width').val() * jQuery('#banner_height').val())
						});
						
				});
				
				jQuery('#banner_height').change(function() {
					
					jQuery('body').find('.slideimageholder').each(function(i) {
							jQuery(this).height(350 / jQuery('#banner_width').val() * jQuery('#banner_height').val());
							//jQuery(this).height(350);// / jQuery('#banner_width').val() * jQuery('#banner_height').val())
						});
						
				});
			
			// LOAD THE GOOGLE FONT
				
				jQuery('head').append("<link href='http://fonts.googleapis.com/css?family="+jQuery('#banner_font').val()+"' rel='stylesheet' type='text/css'>");
				
				jQuery('#banner_font').live('change',function() {
					
					
					jQuery('head').append("<link href='http://fonts.googleapis.com/css?family="+jQuery('#banner_font').val()+"' rel='stylesheet' type='text/css'>");	
				});
				
				jQuery('.sliderparent').width(100+(420*jQuery("#savediv li").length));

			// BUILD THE EDITOR SLIDES FROM THE SAVED BANNER
				jQuery("#savediv li").each(function(){
						$slide = jQuery(this);

					// Create New Slide	
						$basic_slide.clone(true,true).clone().insertBefore($slidecontainer.find(".newslide"));
						$newslide = $slidecontainer.find("li:last");
						
						$newslide.find('.slideimageholder').height(350 / jQuery('#banner_width').val() * jQuery('#banner_height').val())						

					//	Fill New Slide with Loaded Values	
						$newslide.find("img:first").attr("src",$slide.find("img:first").attr("src"));
						
						$newslide.find(".thumb_title").val($slide.data("thumbtitle"));
						$newslide.find(".thumb_desc").val($slide.data("thumbdesc"));
						
						$newslide.find(".slotamount").val($slide.data('slotamount') || 5);
						//$newslide.find(".videoid").val($slide.data('videoid'));						
						
						// SELECT TRANSITIONS...							
							$newslide.find(".animation option").each(function(j) {
								var topt = jQuery(this);												
								if (topt.val() == $slide.data('transition'))
										topt.attr('selected','selected');
							});
						

					//	Fill Captions with Loaded Values 
						$slide.find("div").each(function(){
							$creative_layer = jQuery(this);

							if($creative_layer.html().lastIndexOf("concrete_img")>=0){
								$basic_caption.find(".caption_text").hide();
								$basic_caption.find(".caption_image").show();

							}
							else{
								$basic_caption.find(".caption_text").show();
								$basic_caption.find(".caption_image").hide();
							}

							$basic_caption.clone(true,true).clone().insertBefore($newslide.find(".new_ones"));
							$newcaption = $newslide.find(".captions li:last");
							
							
							$newcaption.find(".caption").val($creative_layer.html().trim().replace(/\s+/gi,' '));
							$newcaption.find(".animation option[value=" + $creative_layer.attr("class").replace("caption ","") +"]").attr("selected","selected") ;
							$newcaption.find(".xpos").val($creative_layer.data("x"));
							$newcaption.find(".ypos").val($creative_layer.data("y"));
							$newcaption.find(".text_color").val(cssColorToHex($creative_layer.css("color")));
							$newcaption.find(".background_color").val(cssColorToHex($creative_layer.css("background-color")));
							$newcaption.find(".averis_caption_background_image").val($creative_layer.find(".concrete_img").attr("src"));
							$newcaption.find(".cap_image").attr("src",$creative_layer.find(".concrete_img").attr("src"));
																					
							
							// SELECT TRANSITIONS...							
							$newcaption.find(".transition option").each(function(j) {
								var topt = jQuery(this);
								
								if (topt.val() == $creative_layer.data('transition'))
										topt.attr('selected','selected');
							});
							$newcaption.find(".start").val($creative_layer.data('start'));
							$newcaption.find(".speed").val($creative_layer.data('speed'));
							
						 // THIS IS THE EXTENDED CSS (SAVED IN A DATA VALUE)
							$newcaption.find('.css_extension').val($creative_layer.data('css2'));
							
						// SELECT RESOPNSIVE CSS ISSUES														
							beautyCSS($newcaption.find('.css_extension'));																																	
							
							$newcaption.find('.restab .openclose').each(function(i) {
								if (i>0) jQuery(this).click();
							});
														
							
						});
						
						// LETS DRAW THE SMALL CAPTIONS IN PREVIEW
						setCaptionLive();
						
						
						
						
						// SELECT SLIDER TYPES...				
						/*
							$newslide.find(".slidetype option").each(function(j) {
								var topt = jQuery(this);												
								
								if (topt.val() == $slide.data('slidetype')) {
										topt.attr('selected','selected');
										if (topt.val()!="Image") {
											$newslide.find('.imagetype').hide(200);
											$newslide.find('.videoclass').show(200);
							
										} 
										if (topt.val()=="Image") {
												$newslide.find('.imagetype').show(200);
												$newslide.find('.videoclass').hide(200);
										}
								}
							});
							*/
						$slide.remove();
						
				});	

				
				
			//	IF CSS EXTENSION HAS BEEN EDITED, NEED AN UPDATE AND SOME BEATUY....
				jQuery('.css_extension').live("change",function() {				
					beautyCSS(jQuery(this));				
					setCaptionLive();								
				});
			
			
			// IF UP OR DOWN SMALL BUTTON HAS BEEN CLICKED, THE INPUT VALUE IN THE SAME PARENT DIV SHOULD BE MODIFICATED
				jQuery('.upup').live("click",function() {
					var input = jQuery(this).parent().parent().find('input');
					input.val((parseInt(input.val(),0)+1));
					setCaptionLive();	
				});
				
				jQuery('.downdown').live("click",function() {
					var input = jQuery(this).parent().parent().find('input');
					input.val((parseInt(input.val(),0)-1));
					setCaptionLive();	
				});
			
			
			
			
			//////////////////////////////////////////////////////	
			// Click on Small Image will open a Preview Mode   //
			/////////////////////////////////////////////////////	
				jQuery('.slideimageholder, input.xpos, input.ypos').live("click",function() {
					 var slider = jQuery(this).closest('.slide_li');
					 var imgsrc = jQuery(this).closest('.slide_li').find('img:first').attr('src');
					 var bw = jQuery('#banner_width').val();
					 var bh = jQuery('#banner_height').val();	
					 jQuery('body').append('<div id="big_slideeditor" class="big_slideeditor" style="width:100%;height:100%;"><div class="slide_demo" style="width:'+bw+'px;"><div id="icon-captioneditor">Cusstom Caption Positions</div><div id="grid-slide-demo" style="width:'+(bw)+'px;height:'+(bh)+'px;"></div><div id="demoholder_now" style="width:'+(bw)+'px;height:'+(bh)+'px; overflow:hidden;"><img width="100%" src="'+imgsrc+'"></div></div></div>');					 
					 
					 var $actslide = jQuery('body').find('.slide_demo');
					 $actslide.append('<div class="tools-info"><strong>Drag and Drop</strong> the Captions into the right position.<br>FineTune it (pixel accuracy) with the small arrow buttons in X/Y Position.</div><div class="tools-captioneditor"><div id="cancel-captioneditor">CANCEL</div><div id="ok-captioneditor">OK</div><div id="grid-captioneditor" class="selected">GRID</div></div>');
				
				// TURN ON AND OFF THE GRID ON THE BANNER
					 jQuery('#grid-captioneditor').click(function() {
						
						console.log("HER"+Math.random()*200);
						if (jQuery('#grid-captioneditor').hasClass("selected")) {
							jQuery('#grid-captioneditor').removeClass("selected") 
							jQuery('#grid-slide-demo').fadeOut(250);
						} else {
							jQuery('#grid-captioneditor').addClass("selected") 
							jQuery('#grid-slide-demo').fadeIn(250);
						}
					 });
					 
			 	// Click on Big Editor close the Demo Preview, and goes back to simple Editor Modus
					jQuery('#cancel-captioneditor').click(function() {					
						jQuery('#big_slideeditor').find('*').each(function() {jQuery(this).empty();jQuery(this).remove();});
						jQuery('#big_slideeditor').remove();
						jQuery(this).remove();
					 });
					 
				// CLICK OK TO ACCEPT THA CHANGES HERE 
					 jQuery('#ok-captioneditor').click(function() {
						 jQuery('#big_slideeditor').find('.dragcaptions').each(function() {
							var cap = jQuery(this);						
							
							cap.data('cap').find(".xpos").val(cap.position().left-50);
							cap.data('cap').find(".ypos").val(cap.position().top-70);
						 });
						 jQuery('#big_slideeditor').find('*').each(function() {jQuery(this).empty();jQuery(this).remove();});
						 jQuery('#big_slideeditor').remove();
						 jQuery(this).remove();
						 setCaptionLive();
					 });


				///////////////////////////////////////////////	 
				// ADD ALL THE CAPTIONS TO THE SLIDE HERE    //
				//////////////////////////////////////////////
					slider.find('li').each(function(i) {					
						
						var $caption=jQuery(this);			
						var prop=1;
						var xp = 50 + $caption.find(".xpos").val() * prop;
						var yp = 70 + $caption.find(".ypos").val() * prop;
						var fontsize = $caption.find(".size").val()*prop +"px";							
						var fontcolor = "#"+$caption.find(".text_color").val();
						var captiontext = $caption.find(".caption").val();	
						var bgcolor = '#'+$caption.find(".background_color").val(); 											
						var vp = $caption.find(".vertical_padding").val()*prop + "px";
						var hp = $caption.find(".horizontal_padding").val()*prop + "px";
						var cssextension = $caption.find(".css_extension").val();
						
						var imgsrc = $caption.find(".cap_image").attr("src");
						
						
						var fontfamily = jQuery('#banner_font').val();
						fontfamily = fontfamily.split(":")[0];
						if (fontfamily=="") fontfamily = "Arial";
						fontfamily = "'"+fontfamily+"'";
						
						if($caption.find(".caption_image").is(':visible')){
							$actslide.find('#demoholder_now').append('<div class="democaptions dragcaptions" style="position:absolute; z-index:10;top:'+yp+'px; left:'+xp+'px;"><img src="'+imgsrc+'"></div>');												
						} else {
							$actslide.find('#demoholder_now').append('<div class="democaptions dragcaptions" style="line-height:1;padding:'+vp+' '+hp+';background:'+bgcolor+';font-size:'+fontsize+';font-family:'+fontfamily+';color:'+fontcolor+';position:absolute; z-index:10;top:'+yp+'px; left:'+xp+'px; '+cssextension+'">'+captiontext+'</div>');						
						}
						
						$actslide.find('#demoholder_now').css({'overflow':'hidden'});
						$actslide.find('.dragcaptions:eq('+i+')').data('cap',$caption);						
						$actslide.find('.dragcaptions').draggable({
							opacity:0.8,
							snap:false,
							
							
						});
					});
					
				});
				
						
			
		
					 
			// Setting Any Input should call the Caption Rebuilder
				jQuery('input').live('change',function() {
						setCaptionLive();
					});


			
				
			// Load other Slider
				jQuery("#load_slider").change(function(){
					top.location.href=jQuery(this).val();
				});
	
			// Sortables
				jQuery( "#slides" ).sortable({});
				jQuery( ".captions" ).sortable({
					connectWith: ".captions"
				});
			
			// Captions Handling
				jQuery(".remove_caption").live("click",function(){
					$this = jQuery(this);
					$this.closest(".caption_li").remove();
					setCaptionLive();
				});

				jQuery(".add_caption").live("click",function(){
					$this = jQuery(this).parent();
					jQuery("#basic_caption_li .caption_li .caption_text").show();
					jQuery("#basic_caption_li .caption_li .caption_image").hide();
					jQuery("#basic_caption_li .caption_li").clone(true,true).insertBefore($this);
					setCaptionLive();
				});

				jQuery(".add_image").live("click",function(){
					$this = jQuery(this).parent();
					jQuery("#basic_caption_li .caption_li .caption_text").hide();
					jQuery("#basic_caption_li .caption_li .caption_image").show();
					jQuery("#basic_caption_li .caption_li").clone(true,true).insertBefore($this);					
					
					setCaptionLive();
				});

			// Slides Handling
				jQuery(".remove_slide").live("click",function(){
					$this = jQuery(this);
					$slidecontainer.width($slidecontainer.width()-420);
					jQuery(".sliderparent").width($slidecontainer.width());
					$this.closest(".slide_li").remove();
					setCaptionLive();
				});

				jQuery(".add_slide").live("click",function(){
					$this = jQuery(this);
					$slidecontainer.width($slidecontainer.width()+420);
					jQuery(".sliderparent").width($slidecontainer.width());
					jQuery("#basic_slide_li .slide_li").clone(true,true).insertBefore($this);
					setCaptionLive();
				});

			// ColorPicker
				var callColorPicker = function($element){
				$element.ColorPicker({
							onSubmit: function(hsb, hex, rgb, el) {
								jQuery(el).val(hex);
								jQuery(el).ColorPickerHide();
							},
							onBeforeShow: function () {
								jQuery(this).ColorPickerSetColor(this.value);
							}
						})
						.bind('keyup', function(){
							jQuery(this).ColorPickerSetColor(this.value);
						});
					$element.click();	
				}

				jQuery(".text_color,.background_color").live("click",function(){
					callColorPicker(jQuery(this));
					
				});


			// Media Upload	
				jQuery('#media-items').bind('DOMNodeInserted',function(){
					jQuery('input[value="Insert into Post"]').each(function(){
							jQuery(this).attr('value','Use This Image');
					});
				});
				
				jQuery('.custom_upload_image_button').click(function() {
					formfield = jQuery(this).siblings('.custom_upload_image');
					preview = jQuery(this).parent().find('.custom_preview_image');
					tb_show('', 'media-upload.php?type=image&TB_iframe=true');
					window.send_to_editor = function(html) {
						imgurl = jQuery('img',html).attr('src');
						classes = jQuery('img', html).attr('class');
						id = classes.replace(/(.*?)wp-image-/, '');
						formfield.val(id);
						preview.attr('src', imgurl);
						tb_remove();
					}
					return false;
				});
				
				jQuery('.custom_clear_image_button').click(function() {
					var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
					jQuery(this).parent().siblings('.custom_upload_image').val('');
					jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
					return false;
				});
				
			// Save DIV
				jQuery(".save-options").click(function(){
					banner = '<ul>';
					
					// each Slide
						jQuery("#slides .slide_li").each(function(){
							$slide = jQuery(this);
							
							banner += '<li data-videoid="'+$slide.find(".videoid").val()+'" data-slidetype="'+$slide.find(".slidetype").val()+'" data-slotamount="'+$slide.find(".slotamount").val()+'" data-transition="'+$slide.find(".animation").val()+'" data-thumbtitle="'+$slide.find(".thumb_title").val()+'" data-thumbdesc="'+$slide.find(".thumb_desc").val()+'"> <img src="'+$slide.find('.slide_image').attr("src")+'" data-thumb="">';
						// each Caption
							$slide.find('.caption_li').each(function(){
								$caption = jQuery(this);			
								
								if($caption.find(".caption_image").is(':visible')){
									banner += '<div class="caption '+$caption.find('.transition').val()+'" data-transition="'+$caption.find('.transition').val()+'" data-start="'+$caption.find('.start').val()+'" data-speed="'+$caption.find('.speed').val()+'" data-x="'+$caption.find('.xpos').val()+'" data-y="'+$caption.find('.ypos').val()+'"><img class="concrete_img" src="'+$caption.find('.cap_image').attr("src")+'"></div>';
								}
								else{
									var fontfamily = jQuery('#banner_font').val();
									fontfamily = fontfamily.split(":")[0];
									if(fontfamily!=""){
										fontfamily = "font-family:'"+fontfamily+"';";
									}


									banner += '<div class="caption '+$caption.find('.transition').val()+'" data-transition="'+$caption.find('.transition').val()											  
											  +'" data-css2="'+$caption.find('.css_extension').val()											  
											  +'" data-start="'+$caption.find('.start').val()+'" data-speed="'+$caption.find('.speed').val()+'" data-x="'+$caption.find('.xpos').val()+'" data-y="'+$caption.find('.ypos').val()
											  +'" style="'+fontfamily+'position:absolute;background-color:#'+$caption.find('.background_color').val()+';color:#'+$caption.find('.text_color').val()+';'+$caption.find('.css_extension').val()+'"'
											  +'>'+$caption.find('.caption').val()+'</div>';								
								}
							});
							banner += '</li>';
						});

					banner += '</ul>';
					jQuery("#banner_list").val(banner);
					//alert(banner);
					document.forms["saveform"].submit();
				});
	
			// Del DIV
				jQuery(".del-options").click(function(){
					jQuery("#delfield_placeholder").html('<input type="text" name="del_banner" value="'+jQuery('#banner_id').val()+'">');
					document.forms["saveform"].submit();
					//return false;
				});
				
		});

		
			
		// MAKE CSS NICE AND SIMPLE 
		function beautyCSS(field) {
			/*var sty = field.val();
			sty=sty.replace(/;/g,';\n');
			sty=sty.replace(@"[(<br( /|)>|<br( /|)>\n)]{2,}", "\n");			
			sty=sty.replace(/ : /g,':');
			field.val(sty);
			*/
			
		}
		
		// Build the Captions as they should look like later
		function setCaptionLive() {
				
				// Remove all the Unneeded Demo Captions first 				
				$slidecontainer.find('.democaptions').each(function() { jQuery(this).remove();});
				
				// Rebuild the Demo Captions as needed...
				$slidecontainer.find('li').each(function() {
					// CALCULATE THE PROPORTIONS AND RESIZE THE CAPTIONS
					var $actslide=jQuery(this);
					var bw = jQuery('#banner_width').val();
					var bh = jQuery('#banner_height').val();					
					var prop = 350 / bw;
					
					$actslide.find('li').each(function(i) { 
					
						var $caption=jQuery(this);						
						var xp = $caption.find(".xpos").val() * prop;
						var yp = $caption.find(".ypos").val() * prop;
						
						var fontcolor = "#"+$caption.find(".text_color").val();
						var captiontext = $caption.find(".caption").val();	
						var bgcolor = '#'+$caption.find(".background_color").val(); 																	
						var cssextension = $caption.find(".css_extension").val();
						
						var fontfamily = jQuery('#banner_font').val();
						fontfamily = fontfamily.split(":")[0];
						fontfamily = "'"+fontfamily+"'";
						
						console.log(fontfamily);
						
						if($caption.find(".caption_image").is(':visible')){
								$actslide.find('.slideimageholder').append('<div class="democaptions latestone" style="position:absolute; z-index:10;top:'+yp+'px; left:'+xp+'px"><img src="'+$caption.find(".caption_image img").attr('src')+'"></div>');
						} else {						
								$actslide.find('.slideimageholder').append('<div class="democaptions latestone" style="line-height:1;background:'+bgcolor+';font-family:'+fontfamily+';color:'+fontcolor+';position:absolute; z-index:10;top:'+yp+'px; left:'+xp+'px;'+cssextension+'">'+captiontext+'</div>');
						}
						
						var latest = $actslide.find('.slideimageholder').find('.latestone');
						latest.removeClass('latestone');
						
						
						
						if (latest.find('img').length>0) {
							
							latest.waitForImages(function() {
							
								var capimg = latest.find('img');							
								capimg.width(capimg.width()*prop);
								//capimg.height(capimg.height() * prop);
							});
						}
						var tp = 0; var bp=0; var lp =0; var rp=0; var fontsize=14;
						var lh = 1;
						try{	var tp = parseInt(latest.css('paddingTop'),0);	} catch(e) {}
						try{	var bp = parseInt(latest.css('paddingBottom'),0);	} catch(e) {}
						try{	var lp = parseInt(latest.css('paddingLeft'),0);	} catch(e) {}
						try{	var rp = parseInt(latest.css('paddingRight'),0);	} catch(e) {}
						try{	var lh = parseInt(latest.css('line-height'),0);	} catch(e) {}
						try{	var fontsize = parseInt(latest.css('font-size'),0);	} catch(e) {}
						

						tp=tp*prop; bp=bp*prop; lp=lp*prop; rp=rp*prop;
						fontsize=fontsize*prop;
						
						if (lh!=1) lh=lh*prop;
						
						latest.css({
										'font-size':fontsize+"px",
										'padding-top':tp+"px",
										'padding-bottom':bp+"px",
										'padding-left':lp+"px",
										'padding-right':rp+"px",
										'line-height':lh+"px"
									});
					});
				});
		}
		
		jQuery.fn.cleanWhitespace = function() {
		    textNodes = this.contents().replace(
				// Replace out the new line character.
				new RegExp( "\\n", "g" ),"");
		    return this;
		}
		
		// Convert RGB to HEX
			var cssColorToHex = function(colorStr){
			    var hex = '';
			    jQuery.each(colorStr.substring(4).split(','), function(i, str){
			        var h = (jQuery.trim(str.replace(')',''))*1).toString(16);
			        hex += (h.length == 1) ? "0" + h : h;
			    });
			    return hex;
			};