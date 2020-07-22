<?php

namespace csip\admin;

use csip\Assets;

// Exit if accessed directly
defined( 'WPINC' ) || die;


/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class Admin {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
        // Load assets from manifest.json
        $this->assets = new Assets();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( PLUGIN_NAME . '/wp/css', $this->assets->get('styles/admin.css'), [], PLUGIN_VERSION, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( PLUGIN_NAME . '/wp/js', $this->assets->get('scripts/admin.js'), [], PLUGIN_VERSION, false );
	}

	/**
	 * Set Custom Post Types file location using Sober/models
	 * WordPress plugin to create custom post types and taxonomies using JSON, YAML or PHP files
	 * Theme uses models.json file located in the directory set in the filter below
	 *
	 * @link( https://github.com/soberwp/models, documentation )
	 */
	public function sober_models_path() {

		return PLUGIN_PATH . 'includes/models';
	}

	/**
	 * Boot Carbon Fields with default IoC dependencies
	 */
	public function boot_custom_fields() {

		\Carbon_Fields\Carbon_Fields::boot();
	}

	/**
	 * Load Custom fields
	 */
	public function register_custom_fields() {

		fields\Options::load();
		fields\Clients::load();
		fields\Invoice::load();
	}

	// Hook to handle next invoice number
	public function onsave_custom_fields() {

		add_action('carbon_fields_post_meta_container_saved', Helpers::set_invoice_number());
	}
}
