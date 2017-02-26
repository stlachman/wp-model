<?php 

	header("Content-Type: text/javascript; charset=utf-8");
	
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	require_once( $path_to_wp.'/wp-includes/functions.php');
	
	$template_uri = get_template_directory_uri();
	$unique = uniqid();
?>

/**
 * jquery.freshline.FlickrPreview - jQuery Plugin for displaying Flickr Streams
 * @version: 1.0 (2011/09/02)
 * @requires jQuery v1.2.2 or later 
 * All Rights Reserved, use only in freshline Templates or when Plugin bought at CodeCanyon ! 
**/

(function($){ 
    $.fn.extend({ 
        //pass the options variable to the function
        flickrPreview: function(options) {
            //Set the default values, use comma to separate the settings, example:
            var defaults = {
                nsid: '67092332@N02',
				sized: 'l',
				feed: '',
				count:4,
				uniq:''
            }
            
            
            
            
            var options =  $.extend(defaults, options);
			
			
            return this.each(function() {
				var holder=$(this);
				var o = options;
                var ts = $(this).attr("id");
				
             	var counter = 0;
				
				$('<div  class=" minigal '+ts+'" \>').appendTo(holder);
				var flickr_feed="http://api.flickr.com/services/feeds/photos_public.gne?id="+o.nsid+"&lang=de-de&format=json&jsoncallback=?";
				if(o.feed!="") flickr_feed=o.feed+"&format=json&jsoncallback=?";
				$.getJSON(flickr_feed, function(data){
				  $.each(data.items, function(i,item){
					counter++;
					
					var itemdesc = $(item.description);
					itemdesc.find('img').attr('src',"");
					newdescription = itemdesc.text().replace(/^.* posted a photo:/g, "");
					
				
					//config special
					if(counter >= o.count-1) var last="last";else var last="";	
					if (counter == o.count-1) var margin="style='margin-right:15px;'";
					else var margin="";					
					
					$("<img/>").attr({
						src : item.media.m.replace("_m","_s"),
						alt: item.title
						}).appendTo('.'+ts).wrap("<div class='bordered listfade-img minigal_div hovering krikiflickr "+last+"'\>").wrap("<div\>").closest("div").attr({
							'class' : 'lightbox covered'
						}).append('<div class="hovering_link"><a href="'+item.link+'" target="_blank"><div class="plink"></div></a></div>');
					
					if(counter==o.count) return false;
				  });
				});
				recallTillGotAll(ts,o.count);					
				
			});
		}	
	});   
})(jQuery);

function recallTillGotAll(holder,count) {		    		
		
		if (count>jQuery("body").find('.krikiflickr').length) {												
				setTimeout(function() {recallTillGotAll(holder,count);},2000);		
				//console.log("Amount of FLickr Items:"+count+"  Loaded Flickrs Items:"+jQuery("body").find('.krikiflickr').length);				
				//console.log('Holder:#'+holder);
			} else {	
			//console.log("Flickr Items loaded all");
			jQuery('.listfade-img').find('>li, .covered').each(function() {						
						var li=jQuery(this);
						var img=li.find('img');
						img.after('<div class="cover"></div>');						
						
						li.hover(
							function() {
								var li=jQuery(this);
								var img=li.find('img');
								var cov = li.find('.cover');
								cov.width(img.width());
								cov.height(img.height());
								
								cov.addClass("selected");
							},
							function() {
								var li=jQuery(this);
								var img=li.find('img');
								var cov = li.find('.cover')
								cov.removeClass("selected");
							});
						
						
					});
			
          }
		 // console.log("Recall Flickr Function Endpoint");
   }

