<?php
/**
 * Widget for booking commerce.
 *
 * @package Booking Commerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register widget for booking commerce.
 */
class Booking_Commerce_Widget extends WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Instantiate the parent object.
		$s = array(
			'classname'   => 'ex_widget',
			'description' => 'This is booking widget.',
		);
		parent::__construct( 'ex_widget', 'Booking Widget',$s );
	}

	/**
	 * Widget content.
	 *
	 * @param array $args arguments.
	 * @param array $instance array of instance.
	 */
	public function widget( $args, $instance ) {
		Booking_Commerce::script();
	}

	/**
	 * Widget Update.
	 *
	 * @param array $new_instance New Instance.
	 * @param array $old_instance New Instance.
	 */
	public function update( $new_instance, $old_instance ) {}

	/**
	 * Widget Update.
	 *
	 * @param array $instance Instance.
	 */
	public function form( $instance ) {}
}
