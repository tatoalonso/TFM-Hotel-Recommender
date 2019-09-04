<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search;


/**
 * Interface SearchInterface
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search
 */
interface SearchInterface
{
    /**
     * @return mixed
     */
    public function getFilter();
}

