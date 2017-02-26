<?php
/* ------------------------------------- */
/* BLOG PAGINATION by Patrick http://www.techspread.de/200/pagination-in-wordpress-theme-einbauen */
/* ------------------------------------- */

function pagination($start_end_links = 3, $middle_links = 3)
{
	global $wp_query;	
	global $current;	
	// Keine Pagination auf Einzelseiten
	if(!is_single())	
	{			
		$current = get_query_var('paged') == 0 ? 1 : get_query_var('paged');	// Derzeitige Seite auslesen
		$total = $wp_query->max_num_pages;										// Gesamtanzahl Seiten
		$links_left = floor(($middle_links - 1) / 2);							// Anzahl Links am Anfang
		$links_right = ceil(($middle_links - 1) / 2);							// Anzahl Links am Ende
		// Pagination nur ausgeben, wenn mehr als eine Index-Seite besteht
		if($total > 1)	
		{				
			// Pagination-Anfang
			echo '
				<div class="clear"></div>
				<div class="pagination">
			';
			// alle "Seiten" durchgehen
			for($i=1; $i<=$total; $i++)	
			{
				// Link auf die derzeitige Seite
				if($i == $current)
				{
					echo '<a class="page marked" href="#">'.($current).'</a>';
				}
				// alle anderen Seiten-Links
				elseif($i >= ($current - $links_left) && $i <= ($current + $links_right) || $i <= $start_end_links || $i > ($total - $start_end_links))
				{
					echo '<a class="page" href="'.get_pagenum_link($i).'">'.$i.'</a>';
				}
				// auszulassene Seiten
				elseif($i == ($start_end_links + 1) && $i < ($current - $links_left + 1) || $i == ($total - $start_end_links) && $i > ($current + $links_right))
				{
					echo '<a class="page">...</a>';
				}
			}
			// Pagination-Ende
			echo '
				</div>';
		}
	}
}
?>