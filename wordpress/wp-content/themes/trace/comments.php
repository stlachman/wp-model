<!-- COMMENTS -->
<?php
/**
 * @package WordPress
 * @subpackage averis_Theme
 */
?>

<?php
	$namelabel = __( 'Name *', 'averis' );
	$emaillabel = __( 'Email *', 'averis' );
	$websitelabel = __( 'Website', 'averis' );
	$messagelabel = __( 'Message *', 'averis' );
	$addreply = __( 'Submit Comment', 'averis' );
	$loggedinas = __( 'You are logged in as', 'averis' ); 
	$clickhereto = __( 'Click here to', 'averis' );
	$logout = __( 'Log out', 'averis' );

	$comments_style="";
?>

<?php if ( post_password_required() ) : ?>
	<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'averis' ); ?></p>		
<?php return; endif; ?>

<?php if ( have_comments() ) { ?>
      	<div class="divide50"></div>
		<div class="titledivider"><?php _e( 'Comments', 'averis' ); ?></div>
		<div class="divide20"></div>
		<div>
			<ul class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'averis_comment' ) ); ?>
			</ul>
			<div class="clear"></div>
			<div class="space70"></div>
		</div>
<?php }   ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
	<div>
		<div class="left marginbottom10"><?php previous_comments_link( __( 'Older Comments ', 'averis' ) ); ?></div>
		<div class="right marginbottom10"><?php next_comments_link( __( 'Newer Comments', 'averis' ) ); ?> </div>
	</div> 
<?php endif;  ?>

<?php if ( comments_open() ) : ?>
    <!-- Comment Form -->
	<div class="divide50"></div>
	<div class="titledivider"><?php comment_form_title(__( 'Leave A Reply', 'averis' ), __( 'Reply To ', 'averis' ).' %s'); ?></div>
	<div class="divide10"></div>						

	    <div id="commentfields" <?php echo $comments_style; ?>><div id="respond"></div>
	        <form name="comment_form_name" method="post" action="<?php echo site_url( '/wp-comments-post.php' ); ?>">
	            <?php if ($user_ID) : ?>
	            <p><?php echo $loggedinas ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <?php echo $clickhereto ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php echo $logout ?></a>.</p>
	            <?php else : ?>
		            <input type="text" name="author" id="author" value="<?php echo $namelabel ?>" class="InputBox requiredfield" />													
					<input type="text" name="email" id="email" value="<?php echo $emaillabel ?>" class="InputBox requiredfield" />													
					<input type="text" name="url" id="url" value="<?php echo $websitelabel ?>" class="InputBox last" />	
		        <?php endif; ?>
		        <div class="clear"></div>
		        <!--input type="hidden" name="comment_post_ID" value="<?php echo $post->ID; ?>" />
		        <input type="hidden" name="_wp_unfiltered_html_comment" value="" /-->
	            
	            <textarea rows="8" id="comment" name="comment" class="TextBox"><?php echo $messagelabel ?></textarea>
				<div class="leftfloat"><input type="submit" id="From_Comment_Go" value="<?php echo $addreply;?>" class="submitbutton bfade"/><?php comment_id_fields(); ?><?php do_action('comment_form', $post->ID); ?></div>
			</form>
	    </div>
	    <div class="clear"></div>

<?php endif; ?>