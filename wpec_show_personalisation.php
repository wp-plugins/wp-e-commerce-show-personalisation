<?php
/*
Plugin Name: WP e-Commerce Show Personalisation
Plugin URI: http://www.leewillis.co.uk/wordpress-plugins/?utm_source=wordpress&utm_medium=www&utm_campaign=wpec-show-personalisation
Description: A simple plugin that shows the personlisation information entered by users in the cart widget, and during checkout.
Author: Lee Willis
Version: 1.1
Author URI: http://www.leewillis.co.uk/
License: GPLv3
*/

if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {

    class wpec_show_personalisation {



	    function __construct() {

		    // Show the personlisation information during checkout
		    add_action( 'wpsc_after_checkout_cart_item_name', array( $this, 'checkout_personalisation_information' ) );
		    add_action( 'wpsc_after_cart_widget_item_name', array( $this, 'cart_widget_personalisation_information' ) );

	    }



	    public function checkout_personalisation_information() {
		    $this->show_personalisation_information( 'checkout' );
	    }



	    public function cart_widget_personalisation_information() {
		    $this->show_personalisation_information( 'cart_widget' );
	    }




	    public function show_personalisation_information( $context ) {

		    global $wpsc_cart;

		    // Seperate out the options into individual items
		    $info = $wpsc_cart->cart_item->custom_message;

		    echo apply_filters( 'wpec_showp_before_info', '<br/><span class="wpec_showp_'.esc_attr ( $context ).'_text">', $context );

			echo nl2br( esc_html( apply_filters( 'wpec_showp_personalisation_info', $info,  $context ) ) );

		    echo apply_filters( 'wpec_showp_after_info', '</span>', $context );

	    }

    }

    $wpec_show_personalisation = new wpec_show_personalisation();

}
