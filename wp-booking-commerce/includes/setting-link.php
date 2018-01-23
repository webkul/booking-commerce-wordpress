<?php
/**
 * Settings content.
 *
 * @package Booking Commerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="main">
	<p class="top"><?php echo __( 'Booking Widget Setting', 'wp_booking' ); ?></p>
	<hr>
	<p><?php echo __( 'Add direct to template : ', 'wp_booking' ); ?></p>
	<textarea  class="code" rows="2" cols="40" >&lt;?php Booking_Commerce::script();?&gt;</textarea>
	<p><?php echo __( ' Directly add from the widget section : ', 'wp_booking' ); ?></p>
	<h4 class="normal"><?php echo __( 'Appearence -> Widgets -> Booking Widget ', 'wp_booking' ); ?></h4>
	<p><?php echo __( 'Or use shortcodes inside your page/article : ', 'wp_booking' ); ?></p>
	<textarea  class="code" rows="2" cols="40" >[book_widget]</textarea>
</div>
