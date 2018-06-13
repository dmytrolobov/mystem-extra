<?php
	/**
		* Plugin Name:       MyStem Extra
		* Plugin URI:        https://wordpress.org/plugins/mystem-extra/
		* Description:       Add extra features to the WordPress theme MyStem.
		* Version:           1.0
		* Author:            lobov
		* Author URI:        https://mystemplus.com/
		* License:           GPL-2.0+
		* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
		* Text Domain:       mystem-extra
	*/
	if ( ! defined( 'WPINC' ) ) {die;}
	
	if( !class_exists( 'MyStem_Extra' ) ) {
	
		final class MyStem_Extra {
			
			private static $instance;
			
			public static function instance() {
				if ( ! isset( self::$instance ) && ! ( self::$instance instanceof MyStem_Extra ) ) {
					self::$instance = new MyStem_Extra;	
					add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				
					self::$instance->includes();
					self::$instance->shortcodes = new MyStem_Category_Temlates();			
			
				}
				return self::$instance;
			}
			
			public function __clone() {
				// Cloning instances of the class is forbidden.
				_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mystem-extra' ), '1.0' );
			}
			
			public function __wakeup() {
				// Unserializing instances of the class is forbidden.
				_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mystem-extra' ), '1.0' );
			}
			
			private function includes() {
				require_once plugin_dir_path( __FILE__ ) . 'category/class-category.php';				
				require_once plugin_dir_path( __FILE__ ) . 'shortcodes/shortcodes.php';				
			
			}
			
			public function load_textdomain() {
				load_plugin_textdomain('mystem-extra', FALSE, dirname( plugin_basename(__FILE__) ) . '/languages/');
			}
		
		
		}
	}
	
	
	function mystem_extra() {
		return MyStem_Extra::instance();
	}	
	
	
	if ( 	'mystem' != get_option( 'template' ) ) {
		if ( ! function_exists( 'mystem_theme_activated' ) ) {
			function mystem_theme_activated() {				
				$message = __( 'This plugin "MyStem Extra" works only with WordPress theme "MyStem". Please, install and activate the theme "MyStem" first (https://wordpress.org/themes/mystem/)', 'mystem-extra'); 
				echo '<div class="notice notice-error"> <p>'. $message .'</p></div>';
			}
			add_action( 'admin_notices', 'mystem_theme_activated' );				
		}
	}
	else {
		mystem_extra();		
	}
	
	
