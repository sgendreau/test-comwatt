<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportAllDataCommand extends Command
{
    protected static $defaultName = 'app:import-all';


    protected function configure(): void
    {
        $this
            ->setDescription('Importe toutes les données.')
            ->setHelp('Importe toutes les données.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'DEBUT Import total',
            '============',
        ]);
        $this->getApplication()->find('app:import-pays')->execute($input, $output);
        $this->getApplication()->find('app:import-type-produit')->execute($input, $output);
        $this->getApplication()->find('app:import-genre')->execute($input, $output);

        $output->writeln([
            'FIN Import',
            '============',
        ]);
        return Command::SUCCESS;
    }
}