<?php


namespace App\HotelApiBundle\Services;

use Exception;
use SplFileInfo;

/**
 * Class CsvFileHandler
 * @package App\HotelApiBundle\Services
 */
class CsvFileHandler
{

    /**
     *
     */
    const CSV = 'csv';

    /**
     * @var SplFileInfo
     */
    private $splFileInfo;

    /**
     * CsvFileHandler constructor.
     * @param SplFileInfo $splFileInfo
     */
    public function __construct (SplFileInfo $splFileInfo)
    {
        $this->splFileInfo= $splFileInfo;

    }

    /**
     * @return bool
     */
    public function isCsvFile():bool
    {
        if ($this->splFileInfo->getExtension() == self::CSV) {

            return true;
        }

        return false;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getFileContent():array
    {
        if ($this->isCsvFile()) {

            $csvArray = array_map('str_getcsv', file($this->splFileInfo->getPathname()));

            array_walk($csvArray, function(&$a) use ($csvArray) {
                $a = array_combine($csvArray[0], $a);
            });

            array_shift($csvArray);

            return $csvArray;

        }else{

            throw new Exception('Not a csv file');
        }




    }

}