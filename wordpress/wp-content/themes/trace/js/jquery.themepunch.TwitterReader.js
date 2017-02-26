/**
 * jquery.freshline.TwitterReader - jQuery Plugin for displaying Twitter Status
 * @version: 1.0 (2011/09/04)
 * @requires jQuery v1.2.2 or later 
 * All Rights Reserved, use only in freshline Templates or when Plugin bought at CodeCanyon ! 
**/

(function($){ 
    $.fn.extend({ 
        //pass the options variable to the function
        twitterReader: function(options) {
            //Set the default values, use comma to separate the settings, example:
            var defaults = {
                user:'traceanalytics',
				count:4
            }
			var options =  $.extend(defaults, options);
			var o = options;
			
			var url = "https://api.twitter.com/1/statuses/user_timeline.json?screen_name="+o.user+"&count="+o.count+"&callback=?";
			
			var holder=$(this);

			
			
					$.getJSON(url,function(data){
						$('<ul class="twitter_reader_list" \>').appendTo(holder);
						var thislist = holder.find('.twitter_reader_list');
						$.each(data, function(i, item) {
						
						//	$(".twitter_reader_list").append("<li>"+item.text.makeLinks()+"<br><span>"+item.created_at.substring(0,item.created_at.lastIndexOf(":"))+"</span></li>");
						thislist.append("<li><div class='twitter_reader_quote'>&rdquo;</div>"+item.text.makeLinks()+"<br><span>"+timeAgo(item.created_at)+"</span></li>");
						});
					});
					String.prototype.makeLinks = function() {
						return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/g, function(str) {
						return str.link(str);});
					}; 
					
					//recallTillGotAll(o.count);		
					
					return this; 
			
			
	  }
	 
});
function timeAgo(dateString) {
        var rightNow = new Date();
        var then = new Date(dateString);
         
        if ($.browser.msie) {
            // IE can't parse these crazy Ruby dates
            then = Date.parse(dateString.replace(/( \+)/, ' UTC$1'));
        }
 
        var diff = rightNow - then;
 
        var second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24,
        week = day * 7;
 
        if (isNaN(diff) || diff < 0) {
            return ""; // return blank string if unknown
        }
 
        if (diff < second * 2) {
            // within 2 seconds
            return "right now";
        }
 
        if (diff < minute) {
            return Math.floor(diff / second) + " seconds ago";
        }
 
        if (diff < minute * 2) {
            return "about 1 minute ago";
        }
 
        if (diff < hour) {
            return Math.floor(diff / minute) + " minutes ago";
        }
 
        if (diff < hour * 2) {
            return "about 1 hour ago";
        }
 
        if (diff < day) {
            return  Math.floor(diff / hour) + " hours ago";
        }
 
        if (diff > day && diff < day * 2) {
            return "yesterday";
        }
 
        if (diff < day * 365) {
            return Math.floor(diff / day) + " days ago";
        }
 
        else {
            return "over a year ago";
        }
    } // timeAgo()
     
     
    function recallTillGotAll(count) {
		
    	if (count>$('body').find('.twitter_reader_list li').length) {
    		setTimeout(function() {recallTillGotAll(count)},1000);
    	} 
    	else {
    		//$("#footer .widget").equalHeights(true);
    	}
    } 
})(jQuery);
