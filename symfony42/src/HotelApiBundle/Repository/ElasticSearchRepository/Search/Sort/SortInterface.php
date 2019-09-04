<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Sort;

interface SortInterface
{
    public function getSort(string $tripTYpe=null);
}