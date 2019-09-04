<?php


namespace App\HotelApiBundle\Services\CacheService;


/**
 * Interface CacheServiceInterface
 * @package App\HotelApiBundle\Services\CacheService
 */
interface CacheServiceInterface
{

    /**
     * @param string $key
     * @return mixed
     */
    public function getCacheItem(string $key);

    /**
     * @param string $key
     * @return bool
     */
    public function existInCache(string $key): bool;

    /**
     * @param string $key
     * @param $value
     */
    public function saveInCache(string $key, $value): void;

    /**
     * @param string $key
     */
    public function cleanCacheItem(string $key): void;

    /**
     *
     */
    public function cleanCache(): void;
}

