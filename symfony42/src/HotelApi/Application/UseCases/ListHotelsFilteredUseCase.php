<?php


namespace App\HotelApi\Application\UseCases;

use App\HotelApi\Domain\Utils\HotelUtils;

/**
 * Class ListHotelsFilteredUseCase
 * @package App\HotelApi\Application\UseCases
 */
class ListHotelsFilteredUseCase
{


    /**
     * @var HotelUtils
     */
    private $hotelRepository;


    /**
     * ListHotelsFilteredUseCase constructor.
     * @param HotelUtils $hotelRepository
     */
    public function __construct(HotelUtils $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @param $queryConditions
     * @return array
     * @throws \Exception
     */
    public function listHotels(array $queryConditions): array
    {
        return $this->hotelRepository->filterHotels($queryConditions);
    }

}