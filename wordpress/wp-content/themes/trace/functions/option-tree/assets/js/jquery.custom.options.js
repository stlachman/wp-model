jQuery(document).ready(function(){
	
	// Google Map Toggle
		if(!jQuery("#aversis_contact_google_map_active_0").attr("checked")){jQuery("#aversis_google_map_div").hide();}
		jQuery("#aversis_contact_google_map_active_0").click(function(){
		   jQuery("#aversis_google_map_div").slideToggle(200);
		});

	// Head Social Icons Toggle
		if(!jQuery("#aversis_header_socialblock_0").attr("checked")){jQuery("#aversis_social_icons_div").hide();}
		jQuery("#aversis_header_socialblock_0").click(function(){
		   jQuery("#aversis_social_icons_div").slideToggle(200);
		});

	// Global SEO Toggle
		if(!jQuery("#aversis_seo_active_0").attr("checked")){jQuery("#aversis_global_seo_begin_div").hide();}
		jQuery("#aversis_seo_active_0").click(function(){
		   jQuery("#aversis_global_seo_begin_div").slideToggle(200);
		});

	// Subfooter Toggle
		if(!jQuery("#aversis_subfooter_active_0").attr("checked")){jQuery("#aversis_subfooter_div").hide();}
		jQuery("#aversis_subfooter_active_0").click(function(){
		   jQuery("#aversis_subfooter_div").slideToggle(200);
		});

	// Blog PostInfo
		if(!jQuery("#aversis_blog_postinfo_active_0").attr("checked")){jQuery("#aversis_blog_postinfo_begin_div").hide();}
		jQuery("#aversis_blog_postinfo_active_0").click(function(){
		   jQuery("#aversis_blog_postinfo_begin_div").slideToggle(200);
		});

	// Blog Socials
		if(!jQuery("#aversis_blog_overview_socials_active_0").attr("checked")){jQuery("#aversis_blog_socials_div").hide();}
		jQuery("#aversis_blog_overview_socials_active_0").click(function(){
		   jQuery("#aversis_blog_socials_div").slideToggle(200);
		});

	// Portfolio PostInfo
		if(!jQuery("#aversis_portfolio_postinfo_active_0").attr("checked")){jQuery("#aversis_portfolio_postinfo_begin").hide();}
		jQuery("#aversis_portfolio_postinfo_active_0").click(function(){
		   jQuery("#aversis_portfolio_postinfo_begin").slideToggle(200);
		});	

	// Portfolio Socials
		if(!jQuery("#aversis_portfolio_overview_socials_active_0").attr("checked")){jQuery("#aversis_portfolio_socials_div").hide();}
		jQuery("#aversis_portfolio_overview_socials_active_0").click(function(){
		   jQuery("#aversis_portfolio_socials_div").slideToggle(200);
		});

	// Portfolio Cuts
		if(!jQuery("#aversis_portfolio_cuts_0").attr("checked")){jQuery("#aversis_portfolio_image_cut_div").hide();}
		jQuery("#aversis_portfolio_cuts_0").click(function(){
		   jQuery("#aversis_portfolio_image_cut_div").slideToggle(200);
		});

	// Blog Cuts
		if(!jQuery("#aversis_blog_cuts_0").attr("checked")){jQuery("#aversis_blog_image_cut_div").hide();}
		jQuery("#aversis_blog_cuts_0").click(function(){
		   jQuery("#aversis_blog_image_cut_div").slideToggle(200);
		});

	// Reset Main Color
	jQuery("input[name=aversis_reset_main_color]").click(function(){
		$this = jQuery(this);
		$that = jQuery("#aversis_main_color");
		$that_colorbox = jQuery("#cp_aversis_main_color div:first");
		switch($this.attr("id"))
		{
			case "aversis_reset_main_color_0":
			  $that.val("#1D78CB");
			  $that_colorbox.attr("style","background-color:#1D78CB;background-image:none;border-color:#1D78CB;")
			  break;
			case "aversis_reset_main_color_1":
			  $that.val("#c91e1e");
			  $that_colorbox.attr("style","background-color:#c91e1e;background-image:none;border-color:#c91e1e;")
			  break;
			case "aversis_reset_main_color_2":
			  $that.val("#ff7700");
			  $that_colorbox.attr("style","background-color:#ff7700;background-image:none;border-color:#ff7700;")
			  break;
			case "aversis_reset_main_color_3":
			  $that.val("#369e19");
			  $that_colorbox.attr("style","background-color:#369e19;background-image:none;border-color:#369e19;")
			  break;
			case "aversis_reset_main_color_4":
			  $that.val("#784e24");
			  $that_colorbox.attr("style","background-color:#784e24;background-image:none;border-color:#784e24;")
			  break;
			default:
				break;
		}
	});

});
