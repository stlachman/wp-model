<?php 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
require_once( $path_to_wp.'/wp-includes/functions.php');
if(get_option("averis_first")!="on"){
	// Set First Fill = true
		update_option("averis_first","on");

	// Sliders
		update_option('banner_4fa2638929ca6_banner_list','&lt;ul&gt;&lt;li data-videoid=&quot;undefined&quot; data-slidetype=&quot;undefined&quot; data-slotamount=&quot;15&quot; data-transition=&quot;slotzoom&quot; data-thumbtitle=&quot;TRUSTED SERVICE&quot; data-thumbdesc=&quot;What We Bring&quot;&gt; &lt;img src=&quot;http://www.dummyimage.com/1020x350/cccccc/ffffff&quot; data-thumb=&quot;&quot;&gt;&lt;div class=&quot;caption lfr&quot; data-transition=&quot;lfr&quot; data-start=&quot;1000&quot; data-speed=&quot;1000&quot; data-x=&quot;437&quot; data-y=&quot;0&quot;&gt;&lt;img class=&quot;concrete_img&quot; src=&quot;http://www.dummyimage.com/229x350/999999/ffffff&quot;&gt;&lt;/div&gt;&lt;div class=&quot;caption lfr&quot; data-transition=&quot;lfr&quot; data-start=&quot;600&quot; data-speed=&quot;800&quot; data-x=&quot;658&quot; data-y=&quot;0&quot;&gt;&lt;img class=&quot;concrete_img&quot; src=&quot;http://www.dummyimage.com/362x350/999999/ffffff&quot;&gt;&lt;/div&gt;&lt;div class=&quot;caption sfl&quot; data-transition=&quot;sfl&quot; data-css2=&quot;text-shadow:none;font-weight:700;font-size:32px;font-family:&#039;PT Sans Narrow&#039;, sans-serif, Helvetica, Arial, sans-serif;&quot; data-start=&quot;1200&quot; data-speed=&quot;500&quot; data-x=&quot;61&quot; data-y=&quot;85&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#NaN000000;color:#000000;text-shadow:none;font-weight:700;font-size:32px;font-family:&#039;PT Sans Narrow&#039;, sans-serif, Helvetica, Arial, sans-serif;&quot;&gt;20 YEARS OF TRUSTED SERVICE&lt;/div&gt;&lt;div class=&quot;caption sfr&quot; data-transition=&quot;sfr&quot; data-css2=&quot;font-family: arial, sans-serif;font-weight: bold;font-size: 18px;text-shadow: 0px 0px 3px #fff;&quot; data-start=&quot;1400&quot; data-speed=&quot;500&quot; data-x=&quot;95&quot; data-y=&quot;144&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#NaN000000;color:#666666;font-family: arial, sans-serif;font-weight: bold;font-size: 18px;text-shadow: 0px 0px 3px #fff;&quot;&gt;Quality Products with 3 Years Warranty&lt;/div&gt;&lt;div class=&quot;caption sfl&quot; data-transition=&quot;sfl&quot; data-start=&quot;1400&quot; data-speed=&quot;500&quot; data-x=&quot;60&quot; data-y=&quot;138&quot;&gt;&lt;img class=&quot;concrete_img&quot; src=&quot;http://www.themepunch.com/averis/wp-content/uploads/2012/05/check_large.png&quot;&gt;&lt;/div&gt;&lt;div class=&quot;caption sfr&quot; data-transition=&quot;sfr&quot; data-css2=&quot;font-family: arial, sans-serif;font-weight: bold;font-size: 18px;text-shadow: 0px 0px 3px #fff;&quot; data-start=&quot;1600&quot; data-speed=&quot;500&quot; data-x=&quot;97&quot; data-y=&quot;184&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#NaN000000;color:#666666;font-family: arial, sans-serif;font-weight: bold;font-size: 18px;text-shadow: 0px 0px 3px #fff;&quot;&gt;24h Support and Customer Service&lt;/div&gt;&lt;div class=&quot;caption sfl&quot; data-transition=&quot;sfl&quot; data-start=&quot;1600&quot; data-speed=&quot;500&quot; data-x=&quot;62&quot; data-y=&quot;178&quot;&gt;&lt;img class=&quot;concrete_img&quot; src=&quot;http://www.themepunch.com/averis/wp-content/uploads/2012/05/check_large1.png&quot;&gt;&lt;/div&gt;&lt;div class=&quot;caption sfr&quot; data-transition=&quot;sfr&quot; data-css2=&quot;font-family: arial, sans-serif;font-weight: bold;font-size: 18px;text-shadow: 0px 0px 3px #fff;&quot; data-start=&quot;1800&quot; data-speed=&quot;500&quot; data-x=&quot;97&quot; data-y=&quot;225&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#NaN000000;color:#666666;font-family: arial, sans-serif;font-weight: bold;font-size: 18px;text-shadow: 0px 0px 3px #fff;&quot;&gt;Basic and Premium Packages&lt;/div&gt;&lt;div class=&quot;caption sfl&quot; data-transition=&quot;sfl&quot; data-start=&quot;1800&quot; data-speed=&quot;500&quot; data-x=&quot;61&quot; data-y=&quot;218&quot;&gt;&lt;img class=&quot;concrete_img&quot; src=&quot;http://www.themepunch.com/averis/wp-content/uploads/2012/05/check_large2.png&quot;&gt;&lt;/div&gt;&lt;/li&gt;&lt;li data-videoid=&quot;undefined&quot; data-slidetype=&quot;undefined&quot; data-slotamount=&quot;25&quot; data-transition=&quot;slotslide&quot; data-thumbtitle=&quot;FAMOUS CLIENTS&quot; data-thumbdesc=&quot;Be Part Of It&quot;&gt; &lt;img src=&quot;http://www.dummyimage.com/1020x350/cccccc/ffffff&quot; data-thumb=&quot;&quot;&gt;&lt;div class=&quot;caption sfb&quot; data-transition=&quot;sfb&quot; data-start=&quot;600&quot; data-speed=&quot;800&quot; data-x=&quot;209&quot; data-y=&quot;90&quot;&gt;&lt;img class=&quot;concrete_img&quot; src=&quot;http://www.dummyimage.com/200x150/999999/ffffff&quot;&gt;&lt;/div&gt;&lt;div class=&quot;caption sft&quot; data-transition=&quot;sft&quot; data-start=&quot;900&quot; data-speed=&quot;800&quot; data-x=&quot;417&quot; data-y=&quot;95&quot;&gt;&lt;img class=&quot;concrete_img&quot; src=&quot;http://www.dummyimage.com/200x150/999999/ffffff&quot;&gt;&lt;/div&gt;&lt;div class=&quot;caption sfb&quot; data-transition=&quot;sfb&quot; data-start=&quot;1200&quot; data-speed=&quot;800&quot; data-x=&quot;610&quot; data-y=&quot;95&quot;&gt;&lt;img class=&quot;concrete_img&quot; src=&quot;http://www.dummyimage.com/200x150/999999/ffffff&quot;&gt;&lt;/div&gt;&lt;/li&gt;&lt;li data-videoid=&quot;undefined&quot; data-slidetype=&quot;undefined&quot; data-slotamount=&quot;5&quot; data-transition=&quot;slotzoom&quot; data-thumbtitle=&quot;ECO FRIENDLY&quot; data-thumbdesc=&quot;Is What We Are!&quot;&gt; &lt;img src=&quot;http://www.dummyimage.com/1020x350/cccccc/ffffff&quot; data-thumb=&quot;&quot;&gt;&lt;div class=&quot;caption sft&quot; data-transition=&quot;sft&quot; data-css2=&quot;text-shadow:none;font-weight:700;font-size:50px;font-family:&#039;PT Sans Narrow&#039;, sans-serif, Helvetica, Arial, sans-serif;&quot; data-start=&quot;600&quot; data-speed=&quot;600&quot; data-x=&quot;254&quot; data-y=&quot;124&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#NaN000000;color:#ffffff;text-shadow:none;font-weight:700;font-size:50px;font-family:&#039;PT Sans Narrow&#039;, sans-serif, Helvetica, Arial, sans-serif;&quot;&gt;WE ARE A GREEN COMPANY&lt;/div&gt;&lt;div class=&quot;caption sfb&quot; data-transition=&quot;sfb&quot; data-css2=&quot;text-shadow:none;font-weight:700;font-size:40px;font-family:&#039;PT Sans Narrow&#039;, sans-serif, Helvetica, Arial, sans-serif;&quot; data-start=&quot;800&quot; data-speed=&quot;600&quot; data-x=&quot;351&quot; data-y=&quot;183&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#NaN000000;color:#ff9c00;text-shadow:none;font-weight:700;font-size:40px;font-family:&#039;PT Sans Narrow&#039;, sans-serif, Helvetica, Arial, sans-serif;&quot;&gt;CONTACT US TODAY!&lt;/div&gt;&lt;/li&gt;&lt;li data-videoid=&quot;undefined&quot; data-slidetype=&quot;undefined&quot; data-slotamount=&quot;15&quot; data-transition=&quot;slotzoom&quot; data-thumbtitle=&quot;OUR OFFICE&quot; data-thumbdesc=&quot;Pleasant Workspace&quot;&gt; &lt;img src=&quot;http://www.dummyimage.com/1020x350/cccccc/ffffff&quot; data-thumb=&quot;&quot;&gt;&lt;div class=&quot;caption sfr&quot; data-transition=&quot;sfr&quot; data-css2=&quot;text-shadow:none;font-weight:700;font-size:38px;font-family:&#039;PT Sans Narrow&#039;, sans-serif, Helvetica, Arial, sans-serif;line-height:1;&quot; data-start=&quot;600&quot; data-speed=&quot;800&quot; data-x=&quot;195&quot; data-y=&quot;283&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#NaN000000;color:#ffffff;text-shadow:none;font-weight:700;font-size:38px;font-family:&#039;PT Sans Narrow&#039;, sans-serif, Helvetica, Arial, sans-serif;line-height:1;&quot;&gt;WOULD YOU LIKE TO WORK HERE?&lt;/div&gt;&lt;div class=&quot;caption sfr&quot; data-transition=&quot;sfr&quot; data-css2=&quot;padding: 10px;font-size:16px;font-weight:700;&quot; data-start=&quot;600&quot; data-speed=&quot;800&quot; data-x=&quot;678&quot; data-y=&quot;285&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#000000;color:#ffffff;padding: 10px;font-size:16px;font-weight:700;&quot;&gt;SEND US YOUR APPLICATION NOW&lt;/div&gt;&lt;/li&gt;&lt;li data-videoid=&quot;undefined&quot; data-slidetype=&quot;undefined&quot; data-slotamount=&quot;10&quot; data-transition=&quot;fade&quot; data-thumbtitle=&quot;SEO READY&quot; data-thumbdesc=&quot;Options Included&quot;&gt; &lt;img src=&quot;http://www.dummyimage.com/1020x350/cccccc/ffffff&quot; data-thumb=&quot;&quot;&gt;&lt;div class=&quot;caption sfb&quot; data-transition=&quot;sfb&quot; data-css2=&quot;padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:10px;font-size:70px;font-weight:700;line-height:1;&quot; data-start=&quot;600&quot; data-speed=&quot;800&quot; data-x=&quot;558&quot; data-y=&quot;158&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#NaN000000;color:#ffffff;padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:10px;font-size:70px;font-weight:700;line-height:1;&quot;&gt;SEO&lt;/div&gt;&lt;div class=&quot;caption sfb&quot; data-transition=&quot;sfb&quot; data-css2=&quot;padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:10px;font-size:26px;font-weight:700;line-height:1;&quot; data-start=&quot;800&quot; data-speed=&quot;800&quot; data-x=&quot;668&quot; data-y=&quot;197&quot; style=&quot;font-family:&#039;PT Sans Narrow&#039;;position:absolute;background-color:#NaN000000;color:#ffffff;padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:10px;font-size:26px;font-weight:700;line-height:1;&quot;&gt;Options On-Board&lt;/div&gt;&lt;/li&gt;&lt;/ul&gt;');
		update_option('banner_4fa2638929ca6_banner_slug','Home Slider');
		update_option('banner_4fa2638929ca6_banner_id','banner_4fa2638929ca6_');
		update_option('banner_4fa2638929ca6_banner_width','1020');
		update_option('banner_4fa2638929ca6_banner_height','350');
		update_option('banner_4fa2638929ca6_banner_font','PT Sans Narrow:400,700');
		update_option('banner_4fa2638929ca6_slide_timer','12000');
		update_option('banner_4fa2638929ca6_slide_thumb_visible','on');
		update_option('banner_4fa2638929ca6_slide_thumb_type','full');
		
		update_option('banner_4faf77eddf965_banner_list','&lt;ul&gt;&lt;li data-videoid=&quot;undefined&quot; data-slidetype=&quot;undefined&quot; data-slotamount=&quot;10&quot; data-transition=&quot;slotfade&quot; data-thumbtitle=&quot;&quot; data-thumbdesc=&quot;&quot;&gt; &lt;img src=&quot;http://www.dummyimage.com/1020x550/cccccc/ffffff&quot; data-thumb=&quot;&quot;&gt;&lt;/li&gt;&lt;li data-videoid=&quot;undefined&quot; data-slidetype=&quot;undefined&quot; data-slotamount=&quot;10&quot; data-transition=&quot;slotfade&quot; data-thumbtitle=&quot;&quot; data-thumbdesc=&quot;&quot;&gt; &lt;img src=&quot;http://www.dummyimage.com/1020x550/cccccc/ffffff&quot; data-thumb=&quot;&quot;&gt;&lt;/li&gt;&lt;li data-videoid=&quot;undefined&quot; data-slidetype=&quot;undefined&quot; data-slotamount=&quot;10&quot; data-transition=&quot;slotfade&quot; data-thumbtitle=&quot;&quot; data-thumbdesc=&quot;&quot;&gt; &lt;img src=&quot;http://www.dummyimage.com/1020x550/cccccc/ffffff&quot; data-thumb=&quot;&quot;&gt;&lt;/li&gt;&lt;/ul&gt;');
		update_option('banner_4faf77eddf965_banner_slug','Blog Slider');
		update_option('banner_4faf77eddf965_banner_id','banner_4faf77eddf965_');
		update_option('banner_4faf77eddf965_banner_width','1020');
		update_option('banner_4faf77eddf965_banner_height','550');
		update_option('banner_4faf77eddf965_banner_font','');
		update_option('banner_4faf77eddf965_slide_timer','12000');
		update_option('banner_4faf77eddf965_slide_thumb_visible','off');
		update_option('banner_4faf77eddf965_slide_thumb_type','long');

		update_option('banner_4fc36db10c1d5_banner_list','&lt;ul&gt;&lt;li data-videoid="undefined" data-slidetype="undefined" data-slotamount="10" data-transition="slotfade" data-thumbtitle="" data-thumbdesc=""&gt; &lt;img src="http://www.dummyimage.com/460x500/cccccc/ffffff" data-thumb=""&gt;&lt;/li&gt;&lt;li data-videoid="undefined" data-slidetype="undefined" data-slotamount="10" data-transition="slotfade" data-thumbtitle="" data-thumbdesc=""&gt; &lt;img src="http://www.dummyimage.com/460x500/cccccc/ffffff" data-thumb=""&gt;&lt;/li&gt;&lt;li data-videoid="undefined" data-slidetype="undefined" data-slotamount="10" data-transition="slotfade" data-thumbtitle="" data-thumbdesc=""&gt; &lt;img src="http://www.dummyimage.com/460x500/cccccc/ffffff" data-thumb=""&gt;&lt;/li&gt;&lt;/ul&gt;');
		update_option('banner_4fc36db10c1d5_banner_slug','Portfolio Slider');
		update_option('banner_4fc36db10c1d5_banner_id','banner_4fc36db10c1d5_');
		update_option('banner_4fc36db10c1d5_banner_width','460');
		update_option('banner_4fc36db10c1d5_banner_height','500');
		update_option('banner_4fc36db10c1d5_banner_font','');
		update_option('banner_4fc36db10c1d5_slide_timer','12000');
		update_option('banner_4fc36db10c1d5_slide_thumb_visible','off');
		update_option('banner_4fc36db10c1d5_slide_thumb_type','long');

		update_option("averis_sliders",array('banner_4fa2638929ca6_','banner_4faf77eddf965_','banner_4fc36db10c1d5_'));
		update_option("averis_sliders_slugs",array('Home Slider','Blog Slider','Portfolio Slider'));

	// Portfolio	
		update_option('averis_portfolio_slug',array('portfolio'));
		update_option('averis_portfolio_name',array('Portfolio'));
}
?>