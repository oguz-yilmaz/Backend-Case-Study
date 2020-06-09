<?php

namespace App\Service\Todo\Providers\Concrete;

use App\Service\Todo\Node;
use App\Service\Todo\Providers\AbstractProvider;

class Provider2 extends AbstractProvider {

	protected $name = "provider2";
	protected $endpoint = "http://www.mocky.io/v2/5d47f235330000623fa3ebf7";

	public function parse( $data ): Node {
		$data = (array) $data;
		$key  = array_keys( $data )[0];

		$node = new Node();
		$node->setId( $key );
		$node->setDuration( $data[ $key ]->{"estimated_duration"} );
		$node->setDifficultyLevel( $data[ $key ]->{"level"} );

		return $node;
	}

}