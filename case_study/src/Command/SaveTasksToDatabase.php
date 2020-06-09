<?php


namespace App\Command;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use App\Service\Todo\Facade;

class SaveTasksToDatabase extends Command {
	// the name of the command (the part after "bin/console")
	protected static $defaultName = 'todo:save';

	public function __construct(ContainerInterface $container)
	{
		parent::__construct();
		$this->container = $container;
	}

	protected function configure() {
		$this->setDescription( 'Saves tasks from defined providers to database.' );
	}

	protected function execute( InputInterface $input, OutputInterface $output ) {

		$section1 = $output->section();
		$section1->writeln('Writing to DB...');

		$em = $this->container->get('doctrine')->getManager();

		Facade::saveProvidersToDb($em);

		$section1->overwrite('Done!');
		return 0;
	}
}