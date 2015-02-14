<?php
// Register Custom Post Type
function register_toggle_psd_cpt() {

    $labels = array(
        'name'                => _x( 'Toggle PSDs', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Toggle PSD', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Toggle PSD', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
        'all_items'           => __( 'All PSDs', 'text_domain' ),
        'view_item'           => __( 'View Item', 'text_domain' ),
        'add_new_item'        => __( 'Add New Item', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'edit_item'           => __( 'Edit Item', 'text_domain' ),
        'update_item'         => __( 'Update Item', 'text_domain' ),
        'search_items'        => __( 'Search Item', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'toggle_psd', 'text_domain' ),
        'description'         => __( 'Contains All PSD\'s', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'thumbnail', ),
        'hierarchical'        => false,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => true,
        'menu_position'       => 99,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
    );
    register_post_type( 'toggle_psd', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_toggle_psd_cpt', 0 );