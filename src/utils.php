<?php

namespace Toggle;

class Utils
{
	public static function toggle_get_setting( $key )
	{
		return toggle()->get_setting( $key );
	}

	public static function toggle_get_path( $file ) {
		return self::toggle_get_setting( 'path' ) . $file;
	}

	public static function toggle_include( $file )
	{
		$path = self::toggle_get_path( $file );

		if ( file_exists( $path ) ) {
			include_once( $path );
		}
	}
}