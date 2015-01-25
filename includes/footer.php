<?php
//Loads the Overlays
add_action( 'wp_footer', 'append_toggle_psd_overlay_images', 30 );

function append_toggle_psd_overlay_images() {

    global $wp_admin_bar;
    global $post;

    $custom_query = Toggle_PSD::get_psds();
    $count = 0;

    $output = '<ul id="footer-toggle-psd-default">';

    while( $custom_query->have_posts() ) :

        $custom_query -> the_post();

        $attr = array(
            'class' => 'toggle-psd-overlay-image',
        );
        $overlay_image = get_the_post_thumbnail( $post->ID, null, $attr );
        $title = get_the_title();

        $output .= '<li id="wp-footer-toggle-psd-' . $count . '"class="toggle-psd-node-container">';
            $output .= '<div class="toggle-psd-node location-footer" data-state="hidden" data-node-id="' . $count . '">';
                $output .= $overlay_image;
            $output .= '</div>';
        $output .= '</li>';

        $count++;

    endwhile;
    wp_reset_query();

    $output .= '</ul>';
    // echo $output;
}