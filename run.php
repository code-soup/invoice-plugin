<?php

// Autoload all classes via composer.
require 'vendor/autoload.php';

use csip\Activator;
use csip\Deactivator;
use csip\PluginInit;

// If this file is called directly, abort.
defined( 'WPINC' ) || die;


// Base plugin Path and URI.
define( 'CSIP_URI', plugin_dir_url( __FILE__ ) );
define( 'CSIP_PATH', plugin_dir_path( __FILE__ ) );

// Plugin details.
define( 'CSIP_NAME', 'InvoiceIT' );
define( 'CSIP_VERSION', '1.0.0' );
define( 'CSIP_TEXT_DOMAIN', 'invoiceit' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/Activator.php
 */
register_activation_hook( __FILE__, array( 'csip\Activator', 'activate' ) );


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/Deactivator.php
 */
register_deactivation_hook( __FILE__, array( 'csip\Deactivator', 'deactivate' ) );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
$cs_plugin = new PluginInit();
$cs_plugin->run();
