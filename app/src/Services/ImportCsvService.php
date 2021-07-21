<?php

namespace App\Services;

use Symfony\Component\Finder\Finder;

class ImportCsvService 
{
    public function parseCsv(array $csvParsingOptions)
    {
        $ignoreFirstLine = $csvParsingOptions['ignoreFirstLine'];

        $finder = new Finder();
        $finder->files()
            ->in($csvParsingOptions['finder_in'])
            ->name($csvParsingOptions['finder_name']);
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