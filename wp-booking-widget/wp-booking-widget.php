<?php
/*
Plugin Name: Booking commerce widget
Version: 1.0
Author: webkul
Description: add a booking commerce widget on sidebar or in a page
*/

if ( ! defined ( 'ABSPATH' ) ) {
  exit;
}

define( 'FILE_NAME', plugin_basename( __FILE__ ) );

if( ! function_exists ( 'booking_commerce' ) ) {
  function booking_commerce() {
    if( ! class_exists( 'Booking_Commerce' ) ) {

      class Booking_Commerce{
        public function __construct() {
          $this->includes();
          add_action('admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
          add_action('admin_menu', array( $this, 'my_menu_item' ) );
          add_action( 'widgets_init', array($this,'myplugin_register_widgets') );
          add_shortcode('book_widget', array( $this, 'sc_require' ) );
          add_action( "plugin_action_links_" . FILE_NAME, array( $this, 'plugin_settings_link' ) );
        }

        function includes() {
            require_once 'includes/widget.php';
        }

        function plugin_settings_link( $links ) {
          $settings_link = '<a href="options-general.php?page=booking-setting">' . __( 'Settings' ) . '</a>';
          array_push( $links, $settings_link );
          return $links;
        }

        function sc_require(){
          return self::script();
        }

        function enqueue_assets(){
          wp_register_style( 'myplugin', plugins_url( 'assets/css/style.css', __FILE__ ) );
          wp_enqueue_style('myplugin');
        }

        function my_menu_item(){
          add_options_page(
            'Booking',
            'Booking',
            'manage_options',
            'booking-setting',
            array( $this, 'my_setting' )
          );
        }

        function my_setting(){
          require_once 'includes/setting_link.php';
        }

        function myplugin_register_widgets() {
        	register_widget( 'MyNewWidget' );
        }

        public static function script() {
          ?>
          <script>(function() {var widget = document.createElement('script');widget.async = true;widget.src = 'http://testcom.bookingcommerce.com/widget/js/widget.js';widget.charset = 'UTF-8';widget.setAttribute('crossorigin', '*');widget.onload = function() {new beWidget({    'baseurl':'http://testcom.bookingcommerce.com/en', 'brandColor': '#1747E3', 'widgetType': 'global'})};document.head.appendChild( widget );})();</script>
          <?php
        }

      }
      new Booking_Commerce();
    }
  }
}

add_action( 'plugins_loaded', 'booking_commerce' );

?>
