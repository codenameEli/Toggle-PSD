<?php

namespace Toggle;

class Activate
{
	public static function init()
	{
		self::create_uploads();
	}

	public static function create_uploads()
	{
		if ( ! current_user_can( 'activate_plugins' ) )
			return;

		$upload_dir = wp_upload_dir();
		$user_dirname = $upload_dir['basedir'].'/'.'toggle';

		if ( ! file_exists( $user_dirname ) )
			wp_mkdir_p( $user_dirname );
	}
}

Activate::init();