
</div>
</div>
<!-- FOOTER -->
	
		<?php 
			if ( function_exists( 'get_option_tree') ) {
				if(get_option_tree( 'aversis_footer_active' )) $aversis_footer_active="on"; else $aversis_footer_active="off";
				if(get_option_tree( 'aversis_subfooter_active' )){ 
						$aversis_subfooter_active="on";
						$subfooter_content = get_option_tree( 'aversis_subfooter_content' );
				}
				else {
					$aversis_subfooter_active="off";
					$subfooter_content="";
				}
			}

			if($aversis_footer_active!="off"){
		?>
			<div class="container footer_container" id="footer">
				<div id="footer_content">
					
				</div>
			</div>
			<?php } ?>

			<?php if($aversis_subfooter_active!="off"){ ?>
<!-- SUB FOOTER -->
			<div class="container subfooter_container" id="sub_footer">
				<div id="subfooter_content">
					<div class="sixteen columns row">	
						<div class="subfootertext"><?php //echo $subfooter_content; ?>
							<div class="sixteen columns alpha omega center subfooter-links">
								Except where otherwise noted, all content &copy; <?php echo date("Y"); ?> Trace Analytics, LLC. All rights reserved.<br />
								Trace Analytics is located at 15768 Hamilton Pool Rd., Austin TX 78738
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<?php } 

		// Google Analytics Code
			echo get_option_tree("aversis_analytics_code");
			?>
			<?php wp_footer(); ?>


</body>
</html>