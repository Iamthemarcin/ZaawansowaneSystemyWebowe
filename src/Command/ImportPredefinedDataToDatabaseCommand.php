<?php

namespace App\Command;

use App\Entity\Constant\City;
use App\Entity\Constant\Craft;
use App\Resources\CitiesArray;
use App\Resources\CraftsArray;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportPredefinedDataToDatabaseCommand extends Command
{
  protected static $defaultName = 'effe:import:predefined_data_to_database';

	private EntityManagerInterface $em;
	
	public function __construct(
		EntityManagerInterface $em,
		string $name = 'effe:import:predefined_data_to_database'
	){
		$this->em = $em;
		
		parent::__construct($name);
	}
	
	protected function configure()
	{
			$this
				->setDescription('Command to import predefined data to database')
			;
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$io = new SymfonyStyle($input, $output);
		ini_set('memory_limit', '2G'); // Just in case
			
		try {
			$io->success("All predefined data has been imported successfully");
			return 0;
		} catch (\Throwable $t) {
			$io->error(sprintf('Error during import predefined data to database with message %s', $t->getMessage()));
			return 1;
		}
	}
}
