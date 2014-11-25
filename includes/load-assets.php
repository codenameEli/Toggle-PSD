<?php

add_action( 'wp_enqueue_scripts', 'load_toggle_psd_assets' );

function load_toggle_psd_assets() {

    wp_enqueue_style( 'toggle-psd-css', plugins_url( 'assets/css/toggle-psd.css', dirname(__FILE__) ) );
    wp_enqueue_script( 'toggle-psd-js', plugins_url( 'assets/js/toggle-psd.js', dirname(__FILE__) ), array( 'jquery' ) );
}
