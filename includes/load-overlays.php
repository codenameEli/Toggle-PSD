<?php
//Loads the Overlays
add_action( 'wp_footer', 'get_toggle_psds' );

function get_toggle_psds() {

    global $post;
    global $wp_admin_bar;

    $query_args = array(
        'post_type' => 'toggle_psd',
        'order' => 'ASC',
        'posts_per_page' => 99
    );

    $custom_query = Toggle_PSD_Utils::get_transient( 'toggle-psd-overlays', $query_args );
    $count = 0;

    $output = '<ul id="listOfOverlays">';

    while( $custom_query->have_posts() ) :

        $custom_query -> the_post();

        // Get the overlay to put in the list
        $thumbnail = get_the_post_thumbnail( $post->ID );
        $attr = array(
            'class' => 'state-hidden wp-admin-bar-toggle-psd-' . $count,
            'title' => '',
        );

        // Get the image to output it to the list
        $overlayImage = get_the_post_thumbnail( $post->ID, null, $attr );
        // $link = wp_get_attachment_url( $get_post_thumbnail_id( $post->ID ) );
        $title = get_the_title();
        $thumbnailID = get_post_thumbnail_id( $post->ID );
        $link = wp_get_attachment_url( $thumbnailID );

        $output .= '<li class="overlay-image overlay-image-' . $count . '"'. 'data-psd-number="' . $count . '">';
            $output .= $overlayImage;
        $output .= '</li>';

        // Adding in each of the sub-menu items e.g. PSD overlay options
        $wp_admin_bar->add_menu( array(
            'id'    => 'toggle-psd-' . $count,
            'title' => $title,
            'href'  => '',
            'parent'=> 'toggle-psd',
            'meta'      => array(
                'class'     => 'toggle-psd-item state-hidden',
                'html'      => '
                    <img class="state-hidden toggle-psd-overlay toggle-psd-overlay-' . $count . '"' . 'data-psd-number="' . $count . '"src="' . $link . '">'
                ,
            ),
        ));

        $count++;

    endwhile;
    wp_reset_query();

    $output .= '</ul>';
    echo $output;
}