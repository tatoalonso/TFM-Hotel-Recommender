<?php

namespace App\HotelApi\Application\UseCases;


use App\HotelApi\Application\Dto\HotelDto;
use App\HotelApi\Domain\Hotel;
use App\HotelApi\Domain\Repository\HotelRepository;

/**
 * Class RegisterNewHotelUseCase
 * @package App\HotelApi\Application\UseCases
 */
class RegisterNewHotelUseCase
{
    /**
     * @var HotelRepository
     */
    private $hotelRepository;

    /**
     * RegisterNewHotelUseCase constructor.
     * @param HotelRepository $hotelRepository
     */
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @param HotelDto $dto
     */
    public function registerHotel(HotelDto $dto): void
    {
        $hotel = new Hotel ($dto->getId(),
                            $dto->getName(),
                            $dto->getStars(),
                            $dto->getAddress(),
                            $dto->getCountry(),
                            $dto->getCity(),
                            $dto->getLatitude(),
                            $dto->getLongitude(),
                            $dto->getRating(),
                            $dto->getSubratings(),
                            $dto->getTripTypes(),
                            $dto->getPath() );

        $this->hotelRepository->saveHotel($hotel);

    }

}

