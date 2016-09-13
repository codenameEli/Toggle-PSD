<?php

/**
* Plugin Name: Toggle
* Description: testing description
* WordPress plugins and themes
* Author: Tim "Eli" Dalbey
*/

//if ( ! defined( 'WPINC' ) ) die; // Exit if accessed directly

function include_autoloader_toggle()
{
	include plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
}

function activate_toggle()
{
	include plugin_dir_path( __FILE__ ) . 'src/activate.php';
}

function deactivate_toggle()
{
	include plugin_dir_path( __FILE__ ) . 'src/deactivate.php';
}

register_activation_hook( __FILE__, 'activate_toggle' );
register_deactivation_hook(  __FILE__, 'deactivate_toggle' );

include_autoloader_toggle();

function init_toggle()
{
	include(  plugin_dir_path( __FILE__ ) . 'src/toggle.php' );

	$toggle = new Toggle();

	return $toggle;
}

if ( ! class_exists( 'Toggle' ) ) {
	init_toggle();
}
