<?php


namespace App\HotelApi\Application\UseCases;


use App\HotelApi\Application\Dto\RoomDto;
use App\HotelApi\Domain\Room;

class CreateRoomUseCase
{

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


