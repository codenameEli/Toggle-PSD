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

        public static function get_json(){

            global $post;

            $json = array();
            $count = 0;
            $custom_query = self::get_psds();

            while( $custom_query->have_posts() ) :

                $custom_query->the_post();

                $title = get_the_title( $post->ID );
                $element = '#wp-admin-bar-toggle-psd-' . $count;
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $image_source = $image[0];
                $width = $image[1];
                $height = $image[2];

                $data = array(
                    'title'       => $title,
                    'imageSource' => $image_source,
                    'width'       => $width,
                    'height'      => $height,
                    'element'     => $element
                );

                array_push( $json, $data );
                $count++;

            endwhile;
            wp_reset_query();

            return $json;
        }
    }
}