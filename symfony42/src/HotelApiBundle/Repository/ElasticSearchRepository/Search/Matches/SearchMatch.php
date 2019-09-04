<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Matches;


/**
 * Class SearchMatch
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Matches
 */
class SearchMatch implements SearchMatchInterface

{
    /**
     * @param array|null $arrayFieldValue
     * @return array
     */
    public function getMatch(array $arrayFieldValue=null):array
    {
        if (isset($arrayFieldValue)) {
            return [];
        }

        foreach ($arrayFieldValue as $field =>  $value ) {

            $arraySearchOperation[] = [
                $field => [
                    'query'     => $value
                ],
            ];

        }

        return $arraySearchOperation;
    }

}