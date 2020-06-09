<?php


namespace App\Service\Todo\Providers;

use App\Service\Todo\Node;


interface ProviderInterface {

	public function getEndpoint(): string;
	public function parse($data): Node;
	public function getName(): string;

}