<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Sort;


class SortQueryTripType implements SortInterface
{
    public function getSort(string $tripType=null)
    {

        $sort = [
                ["trip_types.".$tripType.".value"=> ["order" =>  "desc"]]
                , "_score"
        ];


        return $sort;


    }


}