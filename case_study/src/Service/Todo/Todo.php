<?php

namespace App\Service\Todo;

use App\Service\Todo\Exceptions\ParserException;
use App\Service\Todo\Exceptions\ResourceNotFoundException;
use App\Service\Todo\Providers\ProviderInterface;

class Todo {

	private $providers = [];
	private $results = [];

	public function __construct() {

	}

	public function addProvider( $providerName, ProviderInterface $provider ) {
		$provider->setName( $providerName );
		$this->providers[ $providerName ] = $provider;

		return $this;
	}

	public function getTasks( $providerName ) {
		$json = json_decode( file_get_contents( $this->providers[ $providerName ]->getEndpoint() ) );
		if ( $json === false ) {
			throw new ResourceNotFoundException( "No tasks defined!" );
		}

		return $json;
	}

	private function _parse( $providerName ) {
		$json = $this->getTasks( $providerName );
		foreach ( $json as $item ) {
			$this->results[ $providerName ][] = $this->providers[ $providerName ]->parse( $item );
		}
	}

	public function parse() {

		try {
			foreach ( $this->providers as $provider ) {
				$this->_parse( $provider->getName() );
			}
		} catch ( \Exception $e ) {
			throw new ParserException( $e->getMessage() );
		}

		return $this->results;
	}

}