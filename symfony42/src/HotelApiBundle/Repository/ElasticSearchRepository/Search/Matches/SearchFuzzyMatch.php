<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Matches;


/**
 * Class SearchFuzzyMatch
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Matches
 */
class SearchFuzzyMatch implements SearchMatchInterface
{
    /**
     * @param array $arrayFieldValue
     * @return array
     */
    public function getMatch(array $arrayFieldValue):array
    {
        if (empty($arrayFieldValue)) {

            return [];
        }

        foreach ($arrayFieldValue as $field =>  $value ) {

            $arraySearchOperation[] = [
                $field => [
                    'query'     => $value,
                    "fuzziness" => "AUTO"
                ],
            ];

        }

        return $arraySearchOperation;
    }


}