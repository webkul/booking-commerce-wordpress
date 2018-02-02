<?php
/**
 * Plugin Name: Booking Commerce Plugin
 * Description: Add a Booking Commerce service using widget, shortcode, etc.
 * Version: 1.0
 * Author: webkul
 * Plugin URI: https://www.bookingcommerce.com
 * Author URI: https://webkul.com
 * Text Domain: wp_booking
 *
 * @package Booking Commerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FILE_NAME', plugin_basename( __FILE__ ) );

if ( ! function_exists( 'booking_commerce' ) ) {
	/**
	 * Activation.
	 */
	function booking_commerce() {
		if ( ! class_exists( 'Booking_Commerce' ) ) {

			/**
			 * Main Class.
			 */
			class Booking_Commerce {

				/**
				 * Constructor.
				 */
				public function __construct() {
					$this->includes();
					add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
					add_action( 'admin_menu', array( $this, 'my_menu_item' ) );
					add_action( 'widgets_init', array( $this, 'myplugin_register_widgets' ) );
					add_shortcode( 'book_widget', array( $this, 'sc_require' ) );
					add_action( 'plugin_action_links_' . FILE_NAME, array( $this, 'plugin_settings_link' ) );
					add_action( 'admin_init', array( $this, 'register_booking_link' ), 0 );
				}

				/**
				 * File include.
				 */
				public function includes() {
						require_once 'includes/class-booking-commerce-widget.php';
				}

				/**
				 * Admin Settings.
				 *
				 * @param array $links Links.
				 */
				public function plugin_settings_link( $links ) {
					$settings_link = '<a href="options-general.php?page=booking-setting">' . __( 'Settings' ) . '</a>';
					array_push( $links, $settings_link );
					return $links;
				}

				/**
				 *for registering setting
				 *
				 *
				 */
				 public function register_booking_link() {

					 register_setting( 'booking-commerce-link', 'booking_link'  );

				 }

				/**
				 * Self Script.
				 */
				public function sc_require() {
					return self::script();
				}

				/**
				 * Assets Handler.
				 */
				public function enqueue_assets() {
					wp_register_style( 'myplugin', plugins_url( 'assets/css/style.css', __FILE__ ) );
					wp_enqueue_style( 'myplugin' );
				}

				/**
				 * Admin Menu.
				 */
				public function my_menu_item() {
					add_options_page(
						'Booking',
						'Booking',
						'read',
						'booking-setting',
						array( $this, 'my_setting' )
					);
				}

				/**
				 * Settings Content.
				 */
				public function my_setting() {
					require_once 'includes/setting-link.php';
				}

				/**
				 * Register Widget.
				 */
				public function myplugin_register_widgets() {
					register_widget( 'Booking_Commerce_Widget' );
				}

				/**
				 * Script for booking commerce.
				 */
				public static function script() {
						$url=get_option( 'booking_commerce_link' );
					?>
					<script>(function() {var widget = document.createElement('script');widget.async = true;widget.src = '<?php echo $url; ?>/widget/js/widget.js';widget.charset = 'UTF-8';widget.setAttribute('crossorigin', '*');widget.onload = function() {new beWidget({    'baseurl':'<?php echo $url; ?>/en', 'brandColor': '#1747E3', 'widgetType': 'global'})};document.head.appendChild( widget );})();</script>
					<?php
				}

			}
			new Booking_Commerce();
		}
	}
}

add_action( 'plugins_loaded', 'booking_commerce' );

register_activation_hook( __FILE__, 'activation_setting' );

function activation_setting() {
	$value = 'http://testcom.bookingcommerce.com';

		update_option( 'booking_link', $value );

	}
