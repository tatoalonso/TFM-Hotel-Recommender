<?php


namespace App\HotelApi\Domain\Utils;


use App\HotelApi\Domain\Hotel;

/**
 * Interface HotelUtils
 * @package App\HotelApi\Domain\Utils
 */
interface HotelUtils
{

    /**
     * @param Hotel $hotel
     */
    public function mapHotel(Hotel $hotel): void;

    /**
     * @param array $queryConditions
     * @return array|null
     */
    public function filterHotels(array $queryConditions): ?array;


}