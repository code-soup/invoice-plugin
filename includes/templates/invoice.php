<?php

get_header();

global $wpdb;

$allowed_html = array(
	'b' => array(),
	'i' => array(),
);



/**
 * Get compeny details
 */
$wp_options_company = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}options WHERE (CONVERT(`option_name` USING utf8) LIKE '%csip_%')", ARRAY_A );

$company_details = array();
foreach ( $wp_options_company as $value ) {
	$company_details[ $value['option_name'] ] = $value['option_value'];
}

$company_terms  = wpautop( wp_kses( $company_details['_csip_company_terms'], $allowed_html ) );
$company_note   = wpautop( wp_kses( $company_details['_csip_company_note'], $allowed_html ) );
$footertext     = wpautop( wp_kses( $company_details['_csip_company_footertext'], $allowed_html ) );



/**
 * Get invoice details
 */
$invoice_details = array();
foreach ( get_post_meta( get_the_ID() ) as $key => $value ) {
	$invoice_details[ $key ] = $value[0];
}

$invoice_payment_account = intval( $invoice_details['_inv_payment_account'] );
$invoice_comment         = wp_kses( $invoice_details['_inv_comment'], 'strip' );

?>


<div class="csip-container">
	<section class="csip-invoice-plugin csip-invoice">

		<header class="csip-invoice-header csip-block csip-mb-40">
			<div class="csip-row">
				<?php require CSIP_PATH . '/includes/templates/invoice/company-details.php'; ?>
			</div>
		</header>


		<article>

			<div class="csip-row csip-invoice-info csip-mb-40">

				<div class="csip-span-8 csip-invoice-name-info">
					<?php require CSIP_PATH . '/includes/templates/invoice/invoice-details.php'; ?>
				</div>

				<div class="csip-span-4 csip-invoice-billto">
					<?php require CSIP_PATH . '/includes/templates/invoice/client-details.php'; ?>
				</div>

			</div>

			<div class="csip-invoice-items">
				<?php require CSIP_PATH . '/includes/templates/invoice/table.php'; ?>
			</div>

			<div class="csip-invoice-payment-info csip-avoid-break">

				<?php require CSIP_PATH . '/includes/templates/invoice/payment-account-details.php'; ?>

				<?php if ( $invoice_comment ) { ?>
				<div class="csip-invoice-note csip-mb-40 csip-avoid-break">
					<h3 class="csip-invoice-title-underlined">
						<?php _e( 'Invoice Note', CSIP_TEXT_DOMAIN ); ?>
					</h3>
					<?php echo wpautop( wp_kses( $invoice_comment, 'post' ) ); ?>
				</div>
				<?php } ?>

			</div>

		</article>

		<?php if ( $company_terms ) : ?>
		<div class="csip-mb-40 csip-avoid-break">
			<h3 class="csip-invoice-title-underlined">
				<?php _e( 'Terms & Conditions', CSIP_TEXT_DOMAIN ); ?>
			</h3>
			<div class="csip-invoice-note">
				<?php echo $company_terms; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $company_note ) : ?>
		<div class="csip-mb-40 csip-avoid-break">
			<h3 class="csip-invoice-title-underlined">
				<?php _e( 'Note', CSIP_TEXT_DOMAIN ); ?>
			</h3>
			<div class="csip-invoice-note">
				<?php echo $company_note; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $footertext ) : ?>
		<div class="csip-invoice-footer">
			<?php echo $footertext; ?>
		</div>
		<?php endif; ?>

	</section>
</div>

<?php
get_footer();
