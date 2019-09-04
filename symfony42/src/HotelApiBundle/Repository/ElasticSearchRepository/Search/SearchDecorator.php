<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository\Search;


/**
 * Class SearchDecorator
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository\Search
 */
class SearchDecorator implements SearchInterface
{
    /**
     * @var SearchInterface
     */
    private $search;
    /**
     * @var array
     */
    private $filters;
    /**
     * @var array
     */
    private $sort;

    /**
     * SearchDecorator constructor.
     * @param SearchInterface $search
     * @param array $filters
     * @param array $sort
     */
    public function __construct(SearchInterface $search, array $filters, array $sort)
    {
        $this->search = $search;
        $this->filters = $filters;
        $this->sort = $sort;
    }


    /**
     * @return array
     */
    public function getFilter()
    {

        $query = $this->search->getFilter();
        $query['bool']['filter'] = $this->filters;

        $paramsDecorated = [
            'body'  => [
                'sort' => $this->sort,
                'query' => $query,
            ],
        ];


        return $paramsDecorated;
    }

}