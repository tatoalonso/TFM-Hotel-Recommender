<?php


namespace App\HotelApi\Domain\Repository;


use App\HotelApi\Domain\Hotel;

/**
 * Interface HotelRepository
 * @package App\HotelApi\Domain\Repository
 */
interface HotelRepository
{

    /**
     * @param Hotel $hotel
     */
    public function saveHotel(Hotel $hotel) :void;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param int $hotelId
     * @return Hotel
     */
    public function findHotelById(int $hotelId): Hotel;

    //public function deleteHotel(int $hotelId): void;

}