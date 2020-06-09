<?php

namespace App\Service\Todo\Providers\Concrete;

use App\Service\Todo\Node;
use App\Service\Todo\Providers\AbstractProvider;

class Provider1 extends AbstractProvider {

	protected $name = "provider1";
	protected $endpoint = "http://www.mocky.io/v2/5d47f24c330000623fa3ebfa";

	public function parse( $data ): Node {
		$node = new Node();
		$node->setId( $data->id );
		$node->setDuration( $data->sure );
		$node->setDifficultyLevel( $data->zorluk );

		return $node;
	}

}