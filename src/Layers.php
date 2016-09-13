<?php

namespace Toggle;

class Layers
{
	protected $layersService;

	public function __construct( LayersService $layersService )
	{
		$this->layersService = $layersService;
	}
}