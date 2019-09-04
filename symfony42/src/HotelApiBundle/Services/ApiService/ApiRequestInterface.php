<?php


namespace App\HotelApiBundle\Services\ApiService;


/**
 * Interface ApiRequestInterface
 * @package App\HotelApiBundle\Services\ApiService
 */
interface ApiRequestInterface
{
    /**
     * @param array $parameters
     * @return array
     */
    public function post(array $parameters): array;
}

