<?php
/* ------------------------------------- */
/* BLOG POST COMMENTS */
/* ------------------------------------- */

function averis_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
    <!-- Reply Start -->
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="posterpic"><?php echo get_avatar( $comment, 60 ); ?></div>
    	<div class="commentwrap" style="margin-bottom:30px">
        	<div class="commentarrow"></div>
            <div class="author"><h5><?php comment_author(); ?></h5></div>
            <div class="timestamp"><?php printf( __( '%1$s', 'averis' ), get_comment_date() ); ?><?php edit_comment_link( __( '(Edit)', 'averis' ), ' ' ); ?></div>
            <div class="postertext"><?php if ( $comment->comment_approved == '0' ) : ?><p><em><?php //_e( $commentmoderation, 'averis' ); ?></em></p><?php endif; ?><?php comment_text(); ?></div>
            <div class="clear"></div>
            <div class="replylink"><?php echo special_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
        </div>

    <!-- Reply End -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'averis' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'averis'), ' ' ); ?></p></li>
	<?php
			break;
	endswitch;
}
?>