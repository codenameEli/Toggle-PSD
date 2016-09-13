<?php

namespace Toggle;

use Toggle\Layers as Layers;

class Admin
{
    public function __construct()
    {
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'admin_menu', array( $this, 'add_admin_page' ) );
    }

    public function register_post_type()
    {
        $singular = 'Layer';
        $plural = $singular . 's';
        $key = 'toggle-layer';

        $labels = array(
            'name' => $singular,
            'singular_name' => $singular,
            'add_new' => 'Add ' . $plural,
            'all_items' => 'All ' . $plural,
            'add_new_item' => 'Add ' . $singular,
            'edit_item' => 'Edit ' . $singular,
            'new_item' => 'New ' . $singular,
            'view_item' => 'View ' . $singular,
            'search_items' => 'Search ' . $plural,
            'not_found' => 'No ' . $plural . ' found',
            'not_found_in_trash' => 'No ' . $plural . ' found in trash',
            'parent_item_colon' => 'Parent ' . $singular
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'publicly_queryable' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'show_ui' => true,
            'show_in_nav_menus' => false,
            'show_in_menu' => true,
            'show_in_admin_bar' => false,
            'supports' => array(
                'title',
                'thumbnail',
            ),
            'can_export' => false,
            'taxonomies' => array(),
            'menu_position' => 100,
            'exclude_from_search' => false,
            'show_in_rest' => true,
        );

        register_post_type( $key, $args );
    }

    public function admin_enqueue_scripts()
    {
        // Third party
        wp_enqueue_script( 'toggle-psd-shim', TOGGLE_VENDOR_ASSETS_URL . '/core-js/client/shim.min.js', array(), TOGGLE_VERSION, false );
        wp_enqueue_script( 'toggle-psd-zone', TOGGLE_VENDOR_ASSETS_URL . '/zone.js/dist/zone.js', array(), TOGGLE_VERSION, false );
        wp_enqueue_script( 'toggle-psd-reflect', TOGGLE_VENDOR_ASSETS_URL . '/reflect-metadata/Reflect.js', array(), TOGGLE_VERSION, false );
        wp_enqueue_script( 'toggle-psd-system', TOGGLE_VENDOR_ASSETS_URL . '/systemjs/dist/system.src.js', array(), TOGGLE_VERSION, false );

        // Toggle JS System Module
        wp_enqueue_script( 'toggle-psd-system-config', TOGGLE_BASE_URL . '/systemjs.config.js', array(), TOGGLE_VERSION, false );

        $layersService = new LayersService();
        $layers = new Layers( $layersService );
    }

    public function render_admin_page()
    {
        ?>
        <script>
          System.import('app').catch(function(err){ console.error(err); });
        </script>
        <my-app>Loading...</my-app>
        <h2>TOGGLEPLS</h2>
        <?php
    }

    public function add_admin_page()
    {
        add_menu_page(
            'Toggle PSD',
            'Toggle PSD',
            'manage_options',
            'toggle-psd',
            array( $this, 'render_admin_page' )
        );
    }
}
