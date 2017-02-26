<?php
/* ------------------------------------- */
/* BREADCRUMBS by Dimox: http://dimox.net/wordpress-breadcrumbs-without-a-plugin/ */
/* ------------------------------------- */

function dimox_breadcrumbs() {

/*   echo '<hr />'; */
  
  $marked = get_query_var('paged');

  $delimiter = '&raquo;';
  $home = __('<i class="icon-home"></i>', 'averis'); // text for the 'Home' link
  $markupstart = "\n".'					<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inline">';
  $markupend =   '</div>';
  
  $before = $markupstart.'<span itemprop="title" class="marked">'; // tag before the marked crumb
  $after = '</span>'.$markupend; // tag after the marked crumb

  // Language Options
/* JAS    $averis_archivebycategory = __('Archive of Category', 'averis'); */
    $averis_archivebycategory = __('', 'averis');
    $averis_searchresultsfor = __('Search Results for', 'averis');
    $averis_poststagged = __('Posts tagged', 'averis');
    $averis_articlespostedby = __('Articles posted by', 'averis');
    $averis_error404 = __('Error 404', 'averis');

	$portfolio_slugs = get_option("averis_portfolio_slug");
	
  if ( !is_front_page() || is_paged() ) {
 
    //echo '<p>';
  

    global $post;
    $homeLink = home_url();
    echo $markupstart . '<a itemprop="url" href="' . $homeLink . '"><span itemprop="title">' . $home . '</span></a></div> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . $averis_archivebycategory. ' "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo $markupstart . '<a itemprop="url" href="' . get_year_link(get_the_time('Y')) . '"><span itemprop="title">' . get_the_time('Y') . '</span></a></div> ' . $delimiter . ' ';
      echo $markupstart . '<a itemprop="url" href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '"><span itemprop="title">' . get_the_time('F') . '</span></a></div> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo $markupstart . '<a itemprop="url" href="' . get_year_link(get_the_time('Y')) . '"><span itemprop="title">' . get_the_time('Y') . '</span></a></div> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() &&  !in_array(get_post_type(),$portfolio_slugs)) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo $markupstart . '<a itemprop="url" href="' . $homeLink . '/' . $slug['slug'] . '/"><span itemprop="title">' . $post_type->labels->singular_name . '</span></a></div> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo "</span>".get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
       echo $before. get_the_title() . $after;
      }
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $markupstart . '<a itemprop="url" href="' . get_permalink($parent) . '"><span itemprop="title">' . $parent->post_title . '</span></a></div> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before .  get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = $markupstart . '<a itemprop="url" href="' . get_permalink($page->ID) . '"><span itemprop="title">' . get_the_title($page->ID) . '</span></a></div>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . $averis_searchresultsfor.' "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . $averis_poststagged.' "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . $averis_articlespostedby.' ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . $averis_error404 . $after;
      
    } elseif ( is_home() ) {
      echo $before . wp_title("") . $after;
	} 
	 //Portfolio-Bread-Start
  if(!is_search()){
		$portfolio_slugs = get_option("averis_portfolio_slug");
		$portfolio_perma = get_option("averis_portfolio_perma");
		$portfolio_counter=0;
		if(is_array($portfolio_slugs)){
      foreach ( $portfolio_slugs as $slug ){
  			if ( get_post_type() == $slug ) {
  			  $parent_id="";
  			  if(isset($_GET["tp"]))
  			  	$parent_id  = $_GET["tp"];
  			  if($parent_id!=""){
  				  $repl_link = get_permalink($parent_id);
  				  $repl = get_the_title($parent_id);
  				  echo $before . $markupstart . '<a itemprop="url" href="'.$repl_link.'"><span itemprop="title">' . $repl . '</span></a></div>' . $after . ' ' . $delimiter . ' ';
  			  }
  			  echo $before . get_the_title() . $after;
  			}
  		}
    }
	}
	//Portfolio-Bread-End
 
    if ( get_query_var('paged') ) {
      /*if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {}
      else echo $before ."<span class='marked'>". get_the_title(). " "; 
      _e('Page','averis');
      echo  ' ' . $marked;
     // if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';*/
    }
 
    //echo '</p>';

  } 
}
?>