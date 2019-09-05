<?php


namespace App\HotelApi\Application\UseCases;


use App\HotelApi\Application\Dto\RoomDto;
use App\HotelApi\Domain\Room;

/**
 * Class CreateRoomUseCase
 * @package App\HotelApi\Application\UseCases
 */
class CreateRoomUseCase
{

    /**
     * @param RoomDto $dto
     * @return Room
     */
    public function createRoom(RoomDto $dto): Room
    {
        $room = new Room ($dto->getType(),
            $dto->getBreakfastIncluded(),
            $dto->getFinalRate(),
            $dto->getFreeCancellation(),
            $dto->getCurrency(),
            $dto->getPaymentType(),
            $dto->getRoomsLeft(),
            $dto->getUrl()
        );

       return $room;

    }

}


