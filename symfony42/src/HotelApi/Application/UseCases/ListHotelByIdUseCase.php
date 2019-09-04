<?php


namespace App\HotelApi\Application\UseCases;


use App\HotelApi\Domain\Hotel;
use App\HotelApi\Domain\Repository\HotelRepository;

/**
 * Class ListHotelByIdUseCase
 * @package App\HotelApi\Application\UseCases
 */
class ListHotelByIdUseCase
{

    /**
     * @var HotelRepository
     */
    private $hotelRepository;


    /**
     * ListHotelByIdUseCase constructor.
     * @param HotelRepository $hotelRepository
     */
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;

    }

    /**
     * @param int $hotelId
     * @return Hotel
     */
    public function findHotelById(int $hotelId): Hotel
    {

        return $this->hotelRepository->findHotelById($hotelId);

    }

}