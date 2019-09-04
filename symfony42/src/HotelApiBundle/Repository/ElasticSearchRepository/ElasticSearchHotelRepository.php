<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository;

use App\HotelApi\Domain\Hotel;


use App\HotelApi\Domain\Utils\HotelUtils;
use Exception;

/**
 * Class ElasticSearchHotelRepository
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository
 */
class ElasticSearchHotelRepository implements HotelUtils
{
    /**
     *
     */
    const INDEX_NAME = 'hotels';
    /**
     *
     */
    const INDEX_TYPE = 'hotel';

    /**
     * @var ElasticSearchClient
     */
    private $client;

    /**
     * ElasticSearchHotelRepository constructor.
     * @param ElasticSearchClient $client
     */
    public function __construct(ElasticSearchClient $client)
    {
        $this->client = $client;

    }

    /**
     * @param Hotel $hotel
     * @throws Exception
     */
    public function mapHotel(Hotel $hotel): void
    {
        try {
            $data = $hotel->hotelToArray();

            $params = [
                'index' => self::INDEX_NAME,
                'type'  => self::INDEX_TYPE,
                'id'    => $data['id'],
                'body'  => $data,
            ];

            $this->client->index($params);

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }
    }

    /**
     * @param array $queryConditions
     * @return array|null
     * @throws Exception
     */
    public function filterHotels(array $queryConditions): ?array
    {
        try {
            $query = [
                'index' => self::INDEX_NAME,
                'type'  => self::INDEX_TYPE,
                'body'  => $queryConditions['body'],

            ];
            //echo json_encode($query, JSON_PRETTY_PRINT);die();
            return $this->client->search($query);

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }

    }





}