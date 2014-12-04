<?php
/*
Plugin Name: Toggle PSD
Plugin URI: https://github.com/codenameEli/Toggle-PSD
Description: A developer-friendly guide to help your site match the design comps.
Author: Tim "Eli" Dalbey
Version: 1.0
*/

/*  Copyright 2014  Tim "Eli" Dalbey  (email : eli@launchdm.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Include all php files in the /includes directory
 *
 * https://gist.github.com/theandystratton/5924570
 */
foreach ( glob( dirname( __FILE__ ) . '/includes/*.php' ) as $file ) { include $file; }
