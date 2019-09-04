<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters;


/**
 * Class FactoryFilter
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters
 */
class FactoryFilter
{
    /**
     * @param array $fields
     * @return array
     */
    public function buildFilter(array $fields):array
    {

        if (empty($fields) ){

            return [];
        }

        foreach ($fields as $key => $value) {

            switch ($key) {

                case "country":

                    $countryFilter = new CountryFilter($value);
                    $filters[]= $countryFilter->getFilter();

                    break;

                case "stars":

                    $starsFilter = new StarsFilter($value['fromStars'],$value['toStars']);
                    $filters[]= $starsFilter->getFilter();

                    break;


                case "rating":

                    $ratingFilter = new RatingFilter($value['fromRating'],$value['toRating']);
                    $filters[]= $ratingFilter->getFilter();

                    break;


            }
        }

        return $filters;
    }

}