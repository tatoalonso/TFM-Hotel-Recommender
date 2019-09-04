<?php


namespace App\HotelApiBundle\Services\ApiService;

use App\HotelApiBundle\Services\CacheService\CacheServiceInterface;

/**
 * Class GuzzleApiRequestDecorated
 * @package App\HotelApiBundle\Services\ApiService
 */
class GuzzleApiRequestDecorated implements ApiRequestInterface
{
    /**
     * @var ApiRequestInterface
     */
    private $apiRequest;
    /**
     * @var CacheServiceInterface
     */
    private $cacheService;

    /**
     * GuzzleApiRequestDecorated constructor.
     * @param ApiRequestInterface $apiRequest
     * @param CacheServiceInterface $cacheService
     */
    public function __construct(ApiRequestInterface $apiRequest , CacheServiceInterface $cacheService)
    {
        $this->apiRequest = $apiRequest;
        $this->cacheService = $cacheService;
    }

    /**
     * @param array $parameters
     * @return string
     */
    private function buildKey(array $parameters):string
    {
        return http_build_query($parameters,"",",");

    }

    /**
     * @param array $parameters
     * @return array
     */
    public function post(array $parameters): array
    {
        $keyCache = $this->buildKey($parameters);

        if (!$this->cacheService->existInCache($keyCache)) {

            $apiResponse = $this->apiRequest->post($parameters);

            $this->cacheService->saveInCache($keyCache, $apiResponse);

            return $apiResponse;

        }

        return $this->cacheService->getCacheItem($keyCache);


    }
}