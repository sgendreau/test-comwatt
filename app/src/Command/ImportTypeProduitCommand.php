<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Finder\Finder;
use App\Services\ImportCsvService;

use App\Entity\RefTypeProduit;

class ImportTypeProduitCommand extends Command
{

    private $csvParsingOptions = array(
        'finder_in' => 'secure_files',
        'finder_name' => 'type_produit.csv',
        'ignoreFirstLine' => true
    );

    protected static $defaultName = 'app:import-type-produit';


    /**
     * ImportReference constructor.
     *
     */
    public function __construct(private EntityManagerInterface $em, private ImportCsvService $importCsvService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Importe les données des types de produit.')
            ->setHelp('Importe les données des types de produit.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ini_set('memory_limit', '-1');
        $output->writeln([
            'DEBUT Import des types de produit',
            '============',
        ]);

        $csv = $this->importCsvService->parseCsv($this->csvParsingOptions);
        /*
         * 0 : uuid
         * 1 : libelle
         */

        foreach ($csv as $key => $line) {
            
            if (isset($line[0]) && isset($line[0][1])) {
                $lineExploded = explode(",", $line[0]);


                $typeProduit = $this->em->getRepository(RefTypeProduit::class)->findOneBy(['uuid' => $lineExploded[0]]);
                if(!$typeProduit){
                    $typeProduit = new RefTypeProduit();
                    $typeProduit->setUuid($lineExploded[0]);
                }
                $typeProduit->setlibelle( $lineExploded[1]);

                $this->em->persist($typeProduit);


            } else {
                $output->writeln([
                    'Erreur lors de l\'import.',
                ]);
                throw new InvalidArgumentException();
            }
        }
        $output->writeln([
            'Enregistrement final...',
        ]);
        $this->em->flush();

        $output->writeln([
            'FIN Import',
            '============',
        ]);

        return Command::SUCCESS;
    }

    
}