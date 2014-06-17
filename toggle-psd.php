<?php
/*
Plugin Name: Toggle PSD
Plugin URI: https://github.com/codenameEli
Description: A developer-friendly guide to help your site match the design comps.
Author: Tim "Eli" Dalbey
Version: 1.0
Plugin URI: https://github.com/codenameEli
*/
/**
 * Include all php files in the /includes directory
 *
 * https://gist.github.com/theandystratton/5924570
 */
foreach ( glob( dirname( __FILE__ ) . '/includes/*.php' ) as $file ) { include $file; }
