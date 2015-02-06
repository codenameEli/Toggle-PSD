<?php

add_action( 'save_post', array( 'Toggle_PSD_Utils', 'update_transient' ) );

if( ! class_exists('Toggle_PSD_Utils') ){

    class Toggle_PSD_Utils {

        public static function get_transient( $transient_name, $query_args ){

            global $post;

            $the_transient = get_transient( $transient_name );

            if ( false === $the_transient )  {

                $custom_query = new WP_Query( $query_args );
                set_transient( $transient_name, $custom_query, 12 * HOUR_IN_SECONDS );
                $the_transient = get_transient( $transient_name );
            }

            return $the_transient;
        }

        public static function update_transient( $post_id ) {

            if ( 'toggle_psd' !== get_post_type( $post_id ) ) {

                return;
            }

            delete_transient( 'toggle-psd-overlays' );
        }
    }
}