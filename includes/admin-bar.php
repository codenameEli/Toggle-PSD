<?php
// Adds the admin bar
add_action( 'wp_before_admin_bar_render', 'add_toggle_psd_admin_bar' );

function add_toggle_psd_admin_bar() {

    global $wp_admin_bar;

    // Adding the top level "Toggle PSD" tab
    $args = array(
        'id'    => 'toggle-psd',
        'title' => 'Toggle PSD',
        'href'  => '',
        'meta'  => array(
            'class' => 'state-hidden'
        ),
    );

    $wp_admin_bar->add_menu( $args );
}