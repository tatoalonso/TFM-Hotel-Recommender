<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters;


/**
 * Interface FilterInterface
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters
 */
interface FilterInterface
{
    /**
     * @return mixed
     */
    public function getFilter();
}