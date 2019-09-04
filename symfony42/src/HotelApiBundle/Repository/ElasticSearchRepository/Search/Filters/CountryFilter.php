<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters;


/**
 * Class CountryFilter
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters
 */
class CountryFilter implements FilterInterface
{
    /**
     * @var
     */
    private $country;

    /**
     * CountryFilter constructor.
     * @param $country
     */
    public function __construct($country)
    {
        $this->country  = $country;
    }

    /**
     * @return array
     */
    public function getFilter()
    {

        $filter = [
            "term" => [
                "country.keyword" => $this->country
            ]
        ];

        return $filter;


    }


}