<?php

use Toggle\Admin as Admin;

class Toggle
{
	public function __construct()
	{
		$this->define_constants();

		if ( is_admin() ) {
			$this->admin = new Admin();
		}

		add_filter( 'upload_dir', array( &$this, 'change_uploads_dir' ) );
	}

	public function change_uploads_dir( $param )
	{
		$dir = '/toggle';

		$param['path'] = $param['basedir'] . $dir;
		$param['url'] = $param['baseurl'] . $dir;

		return $param;
	}

	public function define_constants()
	{
		define( 'TOGGLE_TEXT_DOMAIN', __( 'Toggle', 'toggle' ) );
		define( 'TOGGLE_VERSION', '9.9.9' );
		define( 'TOGGLE_BASE_URL', plugins_url( 'toggle' ) );
		define( 'TOGGLE_ASSETS_URL', TOGGLE_BASE_URL . '/app/assets' );
		define( 'TOGGLE_VENDOR_ASSETS_URL', TOGGLE_BASE_URL . '/node_modules' );

//		define( 'TOGGLE_UPLOADS_URL', TOGGLE_BASE_URL . '/node_modules' );
//		define( 'TOGGLE_UPLOADS_DIR', TOGGLE_BASE_URL . '/node_modules' );
	}

	public static function factory()
	{
		static $instance = false;
		if ( ! $instance ) {
			$instance = new self;
		}

		return $instance;
	}
}
