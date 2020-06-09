<?php


namespace App\Service\Todo\Providers;


abstract class AbstractProvider implements ProviderInterface {

	protected $name;
	protected $endpoint;

	public function __construct( $endpoint = null ) {
		if ( $endpoint ) {
			$this->endpoint = $endpoint;
		}
	}

	public function getName(): string {
		return $this->name;
	}

	public function setName( $name ): void {
		$this->name = $name;
	}

	public function getEndpoint(): string {
		return $this->endpoint;
	}

}