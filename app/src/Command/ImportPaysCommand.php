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

use App\Entity\Pays;

class ImportPaysCommand extends Command
{

    private $csvParsingOptions = array(
        'finder_in' => 'secure_files',
        'finder_name' => 'pays.csv',
        'ignoreFirstLine' => true
    );

    protected static $defaultName = 'app:import-pays';


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
            ->setDescription('Importe les données des pays.')
            ->setHelp('Importe les données des pays.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ini_set('memory_limit', '-1');
        $output->writeln([
            'DEBUT Import',
            '============',
        ]);

        $csv = $this->importCsvService->parseCsv($this->csvParsingOptions);
        /*
         * 0 : id
         * 1 : code
         * 2 : alpha2
         * 3 : alpha3
         * 4 : nom_fr
         * 5 : nom_uk
         */

        foreach ($csv as $key => $line) {
            
            if (isset($line[0]) && isset($line[0][5])) {
                $lineExploded = explode(",", $line[0]);


                $paysExist = $this->em->getRepository(Pays::class)->findOneBy(['alpha3' => $lineExploded[3]]);
                if(!$paysExist){
                    $pays = new Pays();
                    $pays->setAlpha3( $lineExploded[3]);
                    $pays->setNomFr( $lineExploded[4]);
                    $pays->setNomUk( $lineExploded[5]);

                    $this->em->persist($pays);
                }


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

    private function parseCsv()
    {
        $ignoreFirstLine = $this->csvParsingOptions['ignoreFirstLine'];

        $finder = new Finder();
        $finder->files()
            ->in($this->csvParsingOptions['finder_in'])
            ->name($this->csvParsingOptions['finder_name']);
        foreach ($finder as $file) {
            $csv = $file;
        }

        $rows = array();
        if (($handle = fopen($csv->getRealPath(), "r")) !== FALSE) {
            $i = 0;
            while (($data = fgetcsv($handle, null, "\t")) !== FALSE) {
                $i++;
                if ($ignoreFirstLine && $i == 1) {
                    continue;
                }
                $rows[] = str_replace('"', '', $data);

            }
            fclose($handle);
        }

        return $rows;
    }
}