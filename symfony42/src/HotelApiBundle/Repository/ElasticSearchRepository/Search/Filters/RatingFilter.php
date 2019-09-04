<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters;


/**
 * Class RatingFilter
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters
 */
class RatingFilter implements FilterInterface
{

    /**
     * @var null
     */
    private $ratingFrom;
    /**
     * @var null
     */
    private $ratingTo;

    /**
     * RatingFilter constructor.
     * @param null $ratingFrom
     * @param null $ratingTo
     */
    public function __construct($ratingFrom=null , $ratingTo=null)
    {
        $this->ratingFrom  = $ratingFrom;
        $this->ratingTo    = $ratingTo;
    }

    /**
     * @return array|mixed
     */
    public function getFilter()
    {

        $filter = [
            "range" => [
                "rating" => [
                    "gte" => $this->ratingFrom,
                    "lte" => $this->ratingTo
                ]
            ]
        ];

        return $filter;


    }

}