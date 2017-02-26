jQuery(document).ready(function(){
								jQuery('.repeatable-add').click(function() {
									field = jQuery(this).closest('div').find('.custom_repeatable li:last').clone(true);
									fieldLocation = jQuery(this).closest('div').find('.custom_repeatable li:last');
									field.insertAfter(fieldLocation, jQuery(this).closest('div').find('ul')).find("input,textarea").val("");
									return false;
								});
								
								jQuery('.repeatable-remove').click(function(){
									jQuery(this).parent().parent().remove();
									return false;
								});
									
							
						});