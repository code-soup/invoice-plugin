<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; }


$invoice_number  = $invoice_details['_inv_number'];
$invoice_date    = $invoice_details['_inv_date'];
$invoice_due     = $invoice_details['_inv_due_date'];
$client_id       = $invoice_details['_inv_client'];
$invoice_code    = trim( $invoice_prefix ) . str_pad( $invoice_number, 4, '0', STR_PAD_LEFT );

?>

<h2 class="csip-invoice-title">
	<span class="csip-invoice-title-text"><?php _e( 'INVOICE', CSIP_TEXT_DOMAIN ); ?></span>
	<span class="csip-invoice-title-code"><?php echo $invoice_code; ?></span>
</h2>

<ul class="csip-invoice-list">
	<li class="csip-invoice-list-label"><?php _e( 'date', CSIP_TEXT_DOMAIN ); ?></li>
	<li class="csip-invoice-list-entry"><?php echo $invoice_date; ?></li>
	<li class="csip-invoice-list-label"><?php _e( 'due', CSIP_TEXT_DOMAIN ); ?></li>
	<li class="csip-invoice-list-entry"><?php echo $invoice_due; ?></li>
</ul>