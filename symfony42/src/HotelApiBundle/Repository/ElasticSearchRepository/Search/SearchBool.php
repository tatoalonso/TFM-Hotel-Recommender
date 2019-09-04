<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search;


use App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Matches\SearchMatchInterface;

/**
 * Class SearchBool
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search
 */
class SearchBool implements SearchInterface
{

    /**
     * @var SearchMatchInterface
     */
    private $matchType;

    /**
     * @var
     */
    private $must;


    /**
     * SearchBool constructor.
     * @param SearchMatchInterface $matchType
     */
    public function __construct(SearchMatchInterface $matchType)
    {
        $this->matchType = $matchType;
    }


    /**
     * @param array|null $arrayFieldValue
     */
    public function setMust(array $arrayFieldValue= null)
    {

        $arrayMatch = $this->matchType->getMatch($arrayFieldValue);

        foreach ($arrayMatch as $key =>  $value ) {

            $this->must[] = ['match' => $arrayMatch[$key]];
        }


    }

    /**
     * @return array
     */
    public function getFilter()
    {
        return [
            'bool' => [
                'must' => $this->must,
            ],
        ];
    }

}