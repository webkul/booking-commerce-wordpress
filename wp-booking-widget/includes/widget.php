<?php

class MyNewWidget extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
    $s=array(
      'classname'=>'ex_widget',
    'description'=>'This is booking widget.');
		parent::__construct( 'ex_widget', 'Booking Widget',$s );
	}

	function widget( $args, $instance ) {
    Booking_Commerce::script();
  }

	function update( $new_instance, $old_instance ) {}

	function form( $instance ) {}
}
