<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Entity\Todo;
use App\Service\Todo\Algo;
use App\Service\Todo\Node;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController {
	/**
	 * @Route("/", name="main")
	 */
	public function index() {
		$datas = [];

		$entityManager      = $this->getDoctrine()->getManager();
		$providerRepository = $entityManager->getRepository( Provider::class );
		$providers          = $providerRepository->findAll();

		foreach ( $providers as $provider ) {
			$todos = $provider->getTodos();
			$algo  = new Algo( $todos );

			$datas[$provider->getName()]['data'] = $todos;
		    $datas[$provider->getName()]['completedWeek'] = $algo->completedWeek();
		    $datas[$provider->getName()]['lastWeekDevHours'] = $algo->lastWeekDevHours();
		}

		return $this->render( 'main/index.html.twig', [ 'data' => $datas, ] );
	}
}
