<?php


namespace App\HotelApi\Application\UseCases;


use App\HotelApi\Domain\Hotel;
use App\HotelApi\Domain\Utils\HotelUtils;
use App\HotelApiBundle\Repository\ElasticSearchRepository\ElasticSearchHotelRepository;


/**
 * Class MappingHotelsUseCase
 * @package App\HotelApi\Application\UseCases
 */
class MappingHotelsUseCase
{

    /**
     * @var ElasticSearchHotelRepository
     */
    private $hotelRepository;


    /**
     * MappingHotelsUseCase constructor.
     * @param HotelUtils $hotelRepository
     */
    public function __construct(HotelUtils $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @param Hotel $hotel
     * @throws \Exception
     */
    public function mapHotel(Hotel $hotel): void
    {

        $this->hotelRepository->mapHotel($hotel);

    }



}