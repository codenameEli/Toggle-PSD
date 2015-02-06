<?php

// Adds the admin bar
// Only on the front end

if ( !is_admin() ) {

    add_action( 'wp_before_admin_bar_render', 'add_toggle_psd_admin_bar' );
}

function add_toggle_psd_admin_bar() {

    global $wp_admin_bar;

    $args = array(
        'id'    => 'toggle-psd',
        'title' => 'Toggle PSD',
        'href'  => '',
        'meta'  => array(
            // 'class' => 'state-hidden'
        ),
    );

    $wp_admin_bar->add_node( $args );

    add_toggle_psd_admin_bar_subnodes();
}

function add_toggle_psd_admin_bar_subnodes() {

    global $wp_admin_bar;
    global $post;

    $custom_query = Toggle_PSD::get_psds();
    $count = 0;

    while( $custom_query->have_posts() ) :

        $custom_query -> the_post();

        $title = get_the_title( $post->ID );
        $overlay_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        $html = '<div class="toggle-psd-node location-admin-bar" data-state="hidden" data-node-id="' . $count . '" data-image-source="' . $overlay_url . '"></div>';

        $args =  array(
            'id'    => 'toggle-psd-' . $count,
            'title' => $title,
            'href'  => '',
            'parent'=> 'toggle-psd',
            'meta'      => array(
                'class'     => 'toggle-psd-node-container',
                'html'      => $html
            ),
        );

        $wp_admin_bar->add_node( $args );

        $count++;

    endwhile;
    wp_reset_query();
}