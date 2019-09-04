<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters;


/**
 * Class StarsFilter
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters
 */
class StarsFilter implements FilterInterface
{
    /**
     * @var null
     */
    private $starsFrom;
    /**
     * @var null
     */
    private $starsTo;

    /**
     * StarsFilter constructor.
     * @param null $starsFrom
     * @param null $starsTo
     */
    public function __construct($starsFrom=null , $starsTo=null)
    {
        $this->starsFrom  = $starsFrom;
        $this->starsTo    = $starsTo;
    }

    /**
     * @return array|mixed
     */
    public function getFilter()
    {

        $filter = [
            "range" => [
                "stars" => [
                    "gte" => $this->starsFrom,
                    "lte" => $this->starsTo
                ]
            ]
        ];

        return $filter;


    }

}