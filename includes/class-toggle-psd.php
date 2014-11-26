<?php

if( ! class_exists('Toggle_PSD') ){

    class Toggle_PSD {

        public static function get_psds(){

            global $post;

            $query_args = array(
                'post_type' => 'toggle_psd',
                'order' => 'ASC',
                'posts_per_page' => 99
            );

            $custom_query = Toggle_PSD_Utils::get_transient( 'toggle-psd-overlays', $query_args );

            return $custom_query;
        }
    }
}