<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository;

use Elasticsearch\ClientBuilder;


/**
 * Class ElasticSearchClient
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository
 */
class ElasticSearchClient
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var \Elasticsearch\Client
     */
    private $elasticSearchClient;

    /**
     * ElasticSearchClient constructor.
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->host = $host;
        $this->elasticSearchClient= ClientBuilder::create()
            ->setHosts(explode(",",$this->host))
            ->build();

    }

    /**
     * @param array $data
     */
    public function index(array $data): void
    {

        $this->elasticSearchClient->index($data);

    }

    /**
     * @param array $query
     * @return array
     */
    public function search(array $query):array
    {

        return $this->elasticSearchClient->search($query);

    }


}