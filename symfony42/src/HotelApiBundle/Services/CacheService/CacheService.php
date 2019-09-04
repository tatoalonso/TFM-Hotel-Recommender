<?php


namespace App\HotelApiBundle\Services\CacheService;


use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Class CacheService
 * @package App\HotelApiBundle\Services\CacheService
 */
class CacheService implements CacheServiceInterface
{

    /**
     *
     */
    const NAMESPACE = '';
    /**
     *
     */
    const LIFETIME = 180;


    /**
     * @var FilesystemAdapter
     */
    private $cacheService;

    /**
     * CacheService constructor.
     */
    public function __construct()
    {
        $this->cacheService = new FilesystemAdapter(self::NAMESPACE,self::LIFETIME);
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getCacheItem(string $key)
    {
        $cacheValue = $this->cacheService->getItem($key);
        return $cacheValue->get();
    }


    /**
     * @param string $key
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function existInCache(string $key): bool
    {
        $cacheValue = $this->cacheService->getItem($key);
        return ($cacheValue->isHit());
    }

    /**
     * @param string $key
     * @param $value
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function saveInCache(string $key, $value): void
    {
        if ($this->existInCache($key)) {

            $this->cleanCacheItem($key);
        }

        $cacheValue = $this->cacheService->getItem($key);
        $cacheValue->set($value);
        $this->cacheService->save($cacheValue);
    }


    /**
     * @param string $key
     */
    public function cleanCacheItem(string $key): void
    {
        $this->cacheService->deleteItem($key);
    }

    /**
     *
     */
    public function cleanCache(): void
    {
        $this->cacheService->clear();
    }




}