<?php

namespace Toggle;

interface Service
{
	public function get( $args=array() );
	public function set( $collection );
	public function has( $key );
	public function remove( $key );
	public function clear();
}