<?php


namespace App\HotelApi\Application\UseCases;


use App\HotelApi\Domain\Repository\HotelRepository;


/**
 * Class ListHotelsUseCase
 * @package App\HotelApi\Application\UseCases
 */
class ListHotelsUseCase
{
    /**
     * @var HotelRepository
     */
    private $hotelRepository;

    /**
     * ListHotelsUseCase constructor.
     * @param HotelRepository $hotelRepository
     */
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @return array
     */
    public function listAll(): array
    {
        return $this->hotelRepository->findAll();
    }

}
