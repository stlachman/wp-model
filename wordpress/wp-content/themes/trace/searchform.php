<!-- TRACETEMPLATE SEARCHFORM -->
<?php
/**
 * @package WordPress
 * @subpackage Averis
 */

$averis_search = __('Search the Site...', 'averis');

?>
<div id="search">
	<form method="get" action="<?php echo home_url(); ?>/">
		<input type="text" id="Form_Search" name="s" value="<?php echo $averis_search;?>" class="InputBox" />
		<input type="submit" id="Form_Go" value="" class="Button" />
	</form>
</div>	