<?php

/**
 * Payment methods template
 *
 * More info on overriding template files can be found here: https://www.download-monitor.com/kb/overriding-content-templates/
 *
 * @package     Download Monitor\Templates
 * @version     4.9.6
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


/** @var \WPChill\DownloadMonitor\Shop\Checkout\PaymentGateway\Manager $pgm Payment Gateway Manager */
$pgm              = \WPChill\DownloadMonitor\Shop\Services\Services::get()->service( 'payment_gateway' );
$payment_gateways = $pgm->get_enabled_gateways();
$default_gateway  = download_monitor()->service( 'settings' )->get_option( 'default_gateway' );

if ( ! empty( $payment_gateways ) ) {
	?>
    <ul>
		<?php
		foreach ( $payment_gateways as $gateway ) {
			download_monitor()->service( 'template_handler' )->get_template_part( 'shop/checkout/payment-gateway', '', '', array(
				'cart'            => $cart,
				'gateway'         => $gateway,
				'default_gateway' => $default_gateway
			) );
		}
		?>
    </ul>
	<?php
}