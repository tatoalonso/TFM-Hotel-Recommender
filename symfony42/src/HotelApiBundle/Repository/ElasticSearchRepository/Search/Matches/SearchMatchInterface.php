<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Matches;


/**
 * Interface SearchMatchInterface
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Matches
 */
interface SearchMatchInterface
{
    /**
     * @param array $arrayFieldValue
     * @return array
     */
    public function getMatch(array $arrayFieldValue):array ;
}

