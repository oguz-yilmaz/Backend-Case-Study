<?php


namespace App\Service\Todo;

use App\Entity\Provider;
use App\Entity\Todo as TodoEntity;

class Facade {

	public static function saveProvidersToDb( $manager, $cached = true ) {

		$todo = new Todo();

		//load provider classes
		//it would be better to write a config for different paths
		//I will leave it for simplicity
		foreach ( glob( __DIR__ . '/Providers/Concrete/*.php' ) as $file ) {
			require_once $file;

			$basename = basename( $file, '.php' );
			$class    = "App\Service\Todo\Providers\Concrete\\" . $basename;

			if ( class_exists( $class ) ) {
				$obj = new $class;
				$todo->addProvider( $obj->getName(), $obj );
			}
		}

		$providerRepository = $manager->getRepository( Provider::class );

		$results = $todo->parse();

		foreach ( $results as $name => $val ) {
			$provider = $providerRepository->findBy( [
				"name" => $name
			] );

			if ( $provider ) {
				$manager->remove( $provider[0] );
				$manager->flush();
			}
			$provider = new Provider();
			$provider->setName( $name );


			foreach ( $val as $item ) {
				$todo = new TodoEntity();
				$todo->setTodoId( $item->getId() );
				$todo->setDuration( $item->getDuration() );
				$todo->setDifficultyLevel( $item->getDifficultyLevel() );
				$todo->setProvider( $provider );
				$manager->persist( $todo );
			}
			$manager->persist( $provider );
		}
		$manager->flush();
	}

}