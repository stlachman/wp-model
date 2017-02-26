<?php
/* 
Template Name: Invoice / Quote Retrieval
*/

	global $wp_query;
    if(isset($wp_query))
    	$content_array = $wp_query->get_queried_object();
	if(isset($content_array->ID)){
    	$post_id = $content_array->ID;
	}	
	
	$template_uri = get_template_directory_uri();
	
	// Page Options
		$pagecustoms = getOptions();


		// Headline Block On or Off (breadcrumbs too)
		if(isset($pagecustoms["averis_headline_active"])){
			if(isset($pagecustoms["averis_breadcrumbs_active"])){$averis_breadcrumbs_active="on";}else {$averis_breadcrumbs_active="off";}
			$averis_headline_active="on";
			if(isset($pagecustoms["averis_header_title"]))
				$averis_headline = $pagecustoms["averis_header_title"];
			else
				$averis_headline = get_the_title($post_id);
		}
		else {
			$averis_headline_active="off";
		}	

		// Sidebar Options
		if(isset($pagecustoms["averis_activate_sidebar"])){
			$averis_activate_sidebar="on";
			$sidebar_orientation = $pagecustoms["averis_sidebar_orientation"];
			$sidebar = $pagecustoms["averis_sidebar"];
			$post_column_full = "eleven";
			if($sidebar_orientation=="right"){
				$sidebar_class = "offset-by-one omega alpha sidebar";	
				$main_class = "left";
			}
			else {
				$sidebar_class = "leftfloat";
				$main_class = "rightfloatNOT omega"; //JAS
			}
		}
		else {
			$averis_activate_sidebar="off";
			$post_column_full = "sixteen";
			$main_class="";
		}		

	// Blog Options
		if ( function_exists( 'get_option_tree') ) {
		
		}	

?>    

<?php get_header(); ?>
<!-- TRACETEMPLATE INVOICE QUOTE RETRIEVAL -->
<div class="content">
<?php if ($averis_headline_active!="off"){?>

	<!--
	####################################
		-	TITLE && BREADCRUMB	-
	####################################
	-->
	<div class="sixteen columns alpha">							
		<div class="pagetitleholder">								
			<div class="breadcrumb_holder">
				<div class="breadcrumb"><?php 
						if($averis_breadcrumbs_active!="off"){
							if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); 
						}
						else
							echo "<span class='marked'>&nbsp;</span></div>
									<div class='clear'></div>";
					?></div>
				<div class="clear"></div>								
			</div>
			<div class="clear"></div>								
		</div>
	</div>
<?php } ?>

	<div class="clear"></div>
<?php if($averis_activate_sidebar=="off") {?>
	<div class="divide20"></div>
<?php } ?>
<!-- MAIN CONTENT CONTAINER	-->
		<div class="sixteen columns alpha">
			<?php if($averis_activate_sidebar!="off") {?>
				<div class="four columns sidebar <?php echo $sidebar_class;?>">
					 <div class="clear"></div>
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
							
		                       
		                        <div style="margin-bottom:20px"><span class="widget_title">Sidebar Widget</span></div>
		                        <p style="color:#ccc">
		                        	Please configure this Widget in the Admin Panel under Appearance -> Widgets
		                        </p>
		                        <div class="clear"></div>
		                    
		                <?php endif;?>
       				<div class="mobileOnly"><hr class="marb0 mart20" /></div>
				</div>

			<?php } ?>
			<div class="<?php echo $post_column_full." ".$main_class;?> columns" style="overflow:visible;">
					<div class="clear"></div>

			<div class="sixteen columns">
				<h1>Invoice / Quote Retrieval</h1>
				
<?php

if (isset($_GET['CustomerID'])) { $CustomerID = $_GET['CustomerID']; }
if (isset($_GET['QuoteID'])) { $QuoteID = $_GET['QuoteID']; }

if (isset($_POST['PayWith'])) { $PayWith = $_POST['PayWith']; }

$time_start = microtime(true);

if (isset($_GET['QuoteID']) && isset($_GET['CustomerID'])) {

// echo "<h2>This feature is temporarily unavailable. We apologize for the inconvenience.</h2>";

	$lookup = QuoteFetchWithDetail($CustomerID, $QuoteID); 
	
	$BillTo = $lookup->WSM_QuoteFetchWithDetail->OutputQuoteBillTo;
	$BillTo = nl2br($BillTo);
	
	$ShipTo = $lookup->WSM_QuoteFetchWithDetail->OutputQuoteShipTo;
	$ShipTo = nl2br($ShipTo);
	
	$OrderDate		= $lookup->WSM_QuoteFetchWithDetail->OutputQuoteOrderDate;
	$Terms			= $lookup->WSM_QuoteFetchWithDetail->OutputQuoteTerms;
	$Total			= $lookup->WSM_QuoteFetchWithDetail->OutputQuoteTotal;
	$Payments		= $lookup->WSM_QuoteFetchWithDetail->OutputQuoteTotalPayments;
	$AmountDue		= $lookup->WSM_QuoteFetchWithDetail->OutputQuoteAmountDue;
	$LineItems 		= $lookup->WSM_QuoteFetchWithDetail->OutputQuoteLineItems;
	$BillingEmails	= $lookup->WSM_QuoteFetchWithDetail->OutputBillingEmails;
	
	// Make a <table> of the items
	$itemSearch  = array("\n"                            , "|"                    , "<br />"    );
	$itemReplace = array("\n\t\t\t\t<tr>\n\t\t\t\t\t<td>", "</td>\n\t\t\t\t\t<td>", "</td>\n\t\t\t\t</tr>");
	$items = str_replace($itemSearch, $itemReplace, nl2br($LineItems));
	
	// Make our outputs - QuoteTable, for the quote. QuoteForm, for the submission form. QuoteInvalid, for invalid requests
	$QuoteTable = <<< EOF
<p>Please review your Invoice or Quote below; if you have any questions or need changes to be made, please <a href="/contact-an-expert">Contact Us</a>.</p>
<table class="noborder shadow rounded" style="width:80%;">
	<tr>
		<td><strong style="white-space:nowrap;">Customer ID:</strong></td>
		<td>{$CustomerID}</td>
	</tr>
	<tr>
		<td><strong>Quote ID:</strong></td>
		<td>{$QuoteID}</td>
	</tr>
	<tr>
		<td><strong>Bill To:</strong></td>
		<td>{$BillTo}</td>
	</tr>
	<tr>
		<td><strong>Ship To:</strong></td>
		<td>{$ShipTo}</td>
	</tr>
	<tr>
		<td><strong>Order Date:</strong></td>
		<td>{$OrderDate}</td>
	</tr>
<!--	<tr>
		<td><strong>Terms:</strong></td>
		<td>{$Terms}</td>
	</tr> -->
	<tr>
		<td><strong>Line Items:</strong></td>
		<td>
			<table class="invoicetable">
				<tr>
					<th>Qty</th>
					<th>Item</th>
					<th>Description</th>
					<th>Price</th>
					<th>Ext. Price</th>
				</tr>
				<tr>
					<td>{$items}
					<td></td>
					<td></td>
					<td class="textalignright">Total:</td>
					<td>\${$Total}</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td class="textalignright">Payments:</td>
					<td>\${$Payments}</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td class="textalignright"><strong>Amount Due:</strong></td>
					<td><strong>\${$AmountDue}</strong></td>
				</tr>

EOF;

	$QuoteTableSubmit = <<< EOF
				<tr>
					<td colspan="5">
						<table class="wide100">
							<tr>
								<td style="padding: 0 5px 0 5px;">
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="business" value="ruby@airchecklab.com">
										<input type="submit" class="wide100 yellow button" name="viewcart" value="View PayPal Cart" />
										<input type="hidden" name="display" value="1">
									</form>
								</td>
								<td style="padding: 0 5px 0 5px;">
									<form id="quotePurchase" class="product_form_3col" action="https://www.paypal.com/cgi-bin/webscr" method="post">
										<input type="hidden" name="cmd" value="_cart" />
										<input type="hidden" name="add" value="1" />
										<input type="hidden" name="business" value="ruby@airchecklab.com" />
										<input type="hidden" name="item_name" value="AirCheck Quote {$QuoteID} Purchase for Customer {$CustomerID}" />
										<input type="hidden" name="item_number" value="QuotePurchase" />
										<input type="hidden" name="amount" value="{$AmountDue}" />
										<input type="hidden" name="currency_code" value="USD" />
										<input type="hidden" name="shipping" value="0" />
										<input type="hidden" name="shipping2" value="0" />
										<input type="hidden" name="baseamt" value="{$AmountDue}" />
										<input type="hidden" name="basedes" value="Quote Purchase" />
										<input type="hidden" name="on0" value="CustomerID" />
										<input type="hidden" name="os0" value="{$CustomerID}" />
										<input type="hidden" name="on1" value="QuoteID" />
										<input type="hidden" name="os1" value="{$QuoteID}" />
										<input type="hidden" name="return" value="http://www.airchecklab.com/thank-you" />
										<input type="hidden" name="cancel_return" value="http://www.airchecklab.com/products/invoice-quote-retrieval/" />
										<input type="submit" class="wide100 yellow button" name="addcart" value="Add to PayPal Cart" />
									</form>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="padding: 0 5px 0 5px;">
									<form action="" method="post">
										<input type="hidden" name="PayWith" value="cc">
										<input type="submit" class="blue button wide100" name="viewcart" value="Pay Now with Credit Card" />
									</form>
								</td>
							</tr>
						</table>
					</td>
				</tr>				
			</table>
		</td>
	</tr>
</table>
EOF;

	$QuoteTableCCInfo = <<< EOF
				<tr>
					<td colspan="5">
						<div class="form-div contact-wrap">
							<form id="signupForm" class="contact_form" name="frm" method="post" action="/process-credit-card/">
								<fieldset>
								<h1>Payment Information</h1>
								<div class="eight columns">
									
									<input type="hidden" name="CustomerID" value="{$CustomerID}" />
									<input type="hidden" name="QuoteID" value="{$QuoteID}" />
									<input type="hidden" name="AmountDue" value="{$AmountDue}" />
									
									<label class="wide100" for="CreditCardName">Name on Credit Card<span>*</span></label>
									<input class="wide100" type="text" name="CreditCardName" id="CreditCardName" placeholder="Name on Credit Card..." required />
									
									<label class="wide100" for="CreditCardNumber">Credit Card Number<span>*</span></label>
									<input class="wide100" type="number" name="CreditCardNumber" id="CreditCardNumber" placeholder="Credit Card Number..." required />
									
									<label class="wide100" for="CreditCardExp">Expiration Date<span>*</span></label>
									<input class="wide100" type="text" name="CreditCardExp" id="CreditCardExp" placeholder="MM/YYYY" required />
									
									<label class="wide100" for="CreditCardCVV">CVV Code<span>*</span></label>
									<input class="wide100" type="number" name="CreditCardCVV" id="CreditCardCVV" placeholder="CVV..." required />
									
									Keep this credit card for future use? <input type="checkbox" id="KeepCC" name="KeepCC" value="Yes" />
									
									
									<label class="wide100" for="ConfirmationEmail">Email Address<span></span></label>
									<input class="wide100" type="email" name="ConfirmationEmail" id="ConfirmationEmail" placeholder="Email Address..." required />
					</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td class="textalignright">
									<input type="button" class="yellow button" name="cancel" value="Cancel" onclick="window.location=document.documentURI" />
					</td>
					<td>
									<input type="submit" class="blue button" name="submit" value="Submit" />
								</div>
								</fieldset>
							</form>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

EOF;

	$QuoteTablePaid = <<< EOF
				<tr>
					<td colspan="5">
						<form id="quotePurchase" class="product_form_3col">
							<input disabled type="submit" class="wide100 yellow button disabled" name="addcart" value="Already Paid" />
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
EOF;
	
}

$time_end = microtime(true);

/*
echo '<h1>XML Results:</h1>';
echo '<pre>';
print_r( $lookup );
echo '</pre><hr />';
*/

$QuoteForm = <<< EOF
<p>To retrieve your <span class="aircheck">AirCheck<span class="tracecheck">&#x2713;</span>&trade; Invoice or Quote</span>, please enter your Customer ID and Quote ID below:</p>
<div class="eight columns">
	<div id="pr2" class="form-div contact-wrap">
		<form id="QuoteForm" name="frm" class="contact_form widelabel" method="get">
	
			<label for="CustomerID">Customer No.<span>*</span></label>
			<input type="text" name="CustomerID" id="CustomerID" placeholder="Customer Number..." required />
			
			<label for="QuoteID">Invoice / Quote No.<span>*</span></label>
			<input type="text" name="QuoteID" id="QuoteID" placeholder="Invoice / Quote Number..." required />
	
			<h4 class="error errMsg2" style="display:none;">Please correct any highlighted fields above.</h4>
			<input type="submit" style="float:right;" class="blue button" value="Submit Request" />
		</form>
	</div>
</div>
<div class="clearfix"></div>
EOF;

$QuoteInvalid = <<< EOF
<div class="rounded notification error"><p>Your Invoice / Quote Request did not return any matches. Please check your Customer ID and Invoice / Quote Number.</p></div>
<div class="clearfix"></div>
EOF;

// Logic for what to display - the quote, the form, or an error message and the form.
if ( (isset($_GET['CustomerID'])) && (isset($_GET['QuoteID'])) && ($Total !== 'Invalid' && $AmountDue !== '0.00' && $PayWith =='') ) { echo $QuoteTable.$QuoteTableSubmit; }
if ( (isset($_GET['CustomerID'])) && (isset($_GET['QuoteID'])) && ($Total !== 'Invalid' && $AmountDue !== '0.00' && $PayWith =='cc') ) { echo $QuoteTable.$QuoteTableCCInfo; }
if ( (isset($_GET['CustomerID'])) && (isset($_GET['QuoteID'])) && ($Total !== 'Invalid' && $AmountDue == '0.00') ) { echo $QuoteTable.$QuoteTablePaid; }
if ( (isset($_GET['CustomerID'])) && (isset($_GET['QuoteID'])) && ($Total == 'Invalid') ) { echo $QuoteInvalid; echo $QuoteForm; }
if ( (!isset($_GET['CustomerID'])) || (!isset($_GET['QuoteID'])) ) { echo $QuoteForm; }

?>

<?php
$time = round($time_end - $time_start, 5);

/* echo "<!-- <p>query took $time seconds.</p> -->"; */
?>
			</div>

			<div class="clearfix"></div>

					<div class="clear"></div>
					<div class="small right mart20">Is there a problem with this page? Help us fix it - <a href="/report-a-bug">Report a Bug</a></div>
					<div class="clear"></div>
			</div>
		</div>
<!-- END OF CONTENT CONTAINER -->
<?php get_footer(); ?>