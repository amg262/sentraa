<?php

/*
Plugin Name: Sentraa
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: andy
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

/**
 * Class WC_Bom
 *
 * @package WooBom
 */
class Wpbd {

	/**
	 * @var null
	 */
	protected static $instance = null;

	private function __construct() {
		$this->init();
	}

	/**
	 *
	 */
	public function init() {

		$this->create_options();


		add_filter( 'plugin_action_links', [ $this, 'plugin_links' ], 10, 5 );


	}

	/**
	 * @return mixed
	 */
	public function create_options() {

		global $wc_bom_options;

		$key            = 'init';
		$wc_bom_options = get_option( 'wpbd_options' );
		if ( $wc_bom_options[ $key ] !== true ) {
			add_option( 'wpbd_options', [ $key => true ] );
		}

	}


	/**
	 * @return null
	 */
	public static function getInstance() {

		if ( static::$instance === null ) {
			static::$instance = new static;
		}

		return static::$instance;
	}


	/**
	 * @param $actions
	 * @param $plugin_file
	 *
	 * @return array
	 */
	public function plugin_links( $actions, $plugin_file ) {
		static $plugin;

		if ( $plugin === null ) {
			$plugin = plugin_basename( __FILE__ );
		}
		if ( $plugin === $plugin_file ) {
			$settings
				     = [
				'settings' => '<a href="admin.php?page=wc-bom-settings">'
				              . __( 'Settings', 'wc-bom' ) . '</a>',
			];
			$actions = array_merge( $settings, $actions );
		}

		return $actions;
	}
}

$wc_bom = WC_Bom::getInstance();
//global $wc_bom_settings;

//var_dump( $wc_bom_settings );
//add_filter('acf/settings/show_admin', '__return_false');
