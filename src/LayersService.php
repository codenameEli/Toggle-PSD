<?php

namespace Toggle;

class LayersService implements Service
{
	protected $collection = array();

	/**
	 * @param array $args
	 *
	 * @return array
	 */
	public function get( $args=array() )
	{
		if ( ! isset( $args ) ) {
			return $this->collection;
		} else {
			// get the collection...
			// filtered by the args
		}
	}

	/**
	 * get all layers
	 * @return array|null
	 */
	public function getAll()
	{
		$args = array(
			'post_count' => -1,
			'post_type' => 'toggle-layer'
		);

		$query = new \WP_Query( $args );

		return $query->get_posts();
	}

	/**
	 * @param $collection
	 *
	 * @return mixed
	 */
	public function set( $collection )
	{
		return $this->collection = $collection;
	}

	/**
	 * @param $key
	 */
	public function has( $key )
	{
		//
	}

	/**
	 * @param $key
	 */
	public function remove( $key )
	{
		//
	}

	/**
	 *
	 */
	public function clear()
	{
		$this->collection = array();
	}
}