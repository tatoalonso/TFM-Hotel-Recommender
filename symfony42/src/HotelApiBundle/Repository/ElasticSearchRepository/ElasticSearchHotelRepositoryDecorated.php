<?php


namespace App\HotelApiBundle\Repository\ElasticSearchRepository;



use App\HotelApi\Domain\Hotel;
use App\HotelApi\Domain\Utils\HotelUtils;
use App\HotelApiBundle\Services\ApiService\ApiRequestInterface;

/**
 * Class ElasticSearchHotelRepositoryDecorated
 * @package App\HotelApiBundle\Repository\ElasticSearchRepository
 */
class ElasticSearchHotelRepositoryDecorated implements HotelUtils
{
    /**
     * @var HotelUtils
     */
    private $hotelRepository;
    /**
     * @var ApiRequestInterface
     */
    private $apiService;

    /**
     * ElasticSearchHotelRepositoryDecorated constructor.
     * @param HotelUtils $hotelRepository
     * @param ApiRequestInterface $apiService
     */
    public function __construct(HotelUtils $hotelRepository , ApiRequestInterface $apiService)
    {
        $this->hotelRepository = $hotelRepository;
        $this->apiService = $apiService;
    }

    /**
     * @param Hotel $hotel
     */
    public function mapHotel(Hotel $hotel): void{

        $this->hotelRepository->mapHotel($hotel);

    }

    /**
     * @param array $queryConditions
     * @return array|null
     */
    public function filterHotels(array $queryConditions): ?array
    {

        $listHotelsFiltered       = $this->hotelRepository->filterHotels($queryConditions);



        if (empty($listHotelsFiltered['hits']['hits'])){
            return [];
        }
        $arrayElasticSearchHotels = $this->buildElasticSearchArrayById($listHotelsFiltered);
        $arrayKeysHotels          = $this->getArrayKeys($arrayElasticSearchHotels);
        $apiResult                = $this->callApi($queryConditions,$arrayKeysHotels);


        if (empty($apiResult ['root']['hotels'])){
            return [];
        }

        $arrayApiHotels           = $this->buildApiArrayById($apiResult);

        return $this->buildElasticSearchAndApiHotelArray($arrayElasticSearchHotels,$arrayApiHotels);
    }


    /**
     * @param array $listHotelsFiltered
     * @return array
     */
    private function buildElasticSearchArrayById(array $listHotelsFiltered) :?array{


        foreach ($listHotelsFiltered['hits']['hits'] as  $result) {

            $key = $result['_id'];
            $value = $result['_source'];

            $arrayElasticSearchHotels[$key] = $value;
        }


        return $arrayElasticSearchHotels;


    }

    /**
     * @param array $apiResult
     * @return array
     */
    private function buildApiArrayById(array $apiResult) :?array
    {

        foreach ($apiResult['root']['hotels'] as  $apiResultValue) {

            $key = $apiResultValue['hotel_id'];
            $value = $apiResultValue;

            $arrayApiHotels[$key] = $value;
        }


        return $arrayApiHotels;


    }

    /**
     * @param array $arrayElasticSearchHotels
     * @return string
     */
    private function getArrayKeys(array $arrayElasticSearchHotels) :string{

       return  json_encode(array_keys($arrayElasticSearchHotels));

    }

    /**
     * @param array $queryConditions
     * @param string $arrayKeysHotels
     * @return array
     */
    private function callApi(array $queryConditions, string $arrayKeysHotels):array {

        $apiParameters =$queryConditions ['api'];
        $apiParameters['hotels'] = $arrayKeysHotels;

        return $this->apiService->post($apiParameters);

    }

    /**
     * @param array $arrayElasticSearchHotels
     * @param array $arrayApiHotels
     * @return array
     */
    private function buildElasticSearchAndApiHotelArray(array $arrayElasticSearchHotels, array $arrayApiHotels):array
    {

        foreach ($arrayElasticSearchHotels as $elasticSearchKey => $elasticSearchValue) {
            foreach ($arrayApiHotels as $apiKey => $apiValue) {

                if ($elasticSearchKey == $apiKey) {

                    $arrayResponseHotels[] = [
                        'elastic_search' => $elasticSearchValue,
                        'api' => $apiValue
                    ];
                }

            }

        }
        return $arrayResponseHotels;

    }
}



