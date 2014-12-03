<?php

add_action( 'save_post', 'ce_update_transient' );

function ce_update_transient( $post_id ) {

    if ( 'toggle_psd' !== get_post_type( $post_id ) ) {

        return;
    }

    delete_transient( 'toggle-psd-overlays' );
}