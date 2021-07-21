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

use App\Entity\RefTypeGenre;

class ImportGenreCommand extends Command
{

    private $csvParsingOptions = array(
        'finder_in' => 'secure_files',
        'finder_name' => 'genres.csv',
        'ignoreFirstLine' => true
    );

    protected static $defaultName = 'app:import-genre';


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
            ->setDescription('Importe les données des genres.')
            ->setHelp('Importe les données des genres.')
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
         * 1 : libelle
         * 2 : id parent
         */

        foreach ($csv as $key => $line) {
            
            if (isset($line[0]) && isset($line[0][2])) {
                $lineExploded = explode(",", $line[0]);


                $genreExist = $this->em->getRepository(RefTypeGenre::class)->findOneBy(['id' => $lineExploded[0]]);
                if(!$genreExist){
                    $parent = null;
                    if(isset($lineExploded[2])) {
                        $parent = $this->em->getRepository(RefTypeGenre::class)->findOneBy(['id' => $lineExploded[2]]);
                    }
                    $genre = new RefTypeGenre();
                    $genre->setlibelle( $lineExploded[1]);
                    $genre->setGenreParent( $parent);

                    $this->em->persist($genre);
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

    
}