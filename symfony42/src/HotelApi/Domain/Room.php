<?php


namespace App\HotelApi\Domain;


class Room
{

    private $type;

    private $breakfastIncluded;

    private $finalRate;

    private $freeCancellation;

    private $currency;

    private $paymentType;

    private $roomsLeft;

    private $url;


    public function  __construct(string $type, string $breakfastIncluded, int $finalRate, string $freeCancellation, string $currency, string $paymentType, int $roomsLeft, string $url)
    {
        $this->type = $type;
        $this->breakfastIncluded = $breakfastIncluded;
        $this->finalRate = $finalRate;
        $this->freeCancellation = $freeCancellation;
        $this->currency = $currency;
        $this->paymentType = $paymentType;
        $this->roomsLeft = $roomsLeft;
        $this->url = $url;
    }

    public function getType(): string
    {
        return $this->type;
    }


    public function getBreakfastIncluded(): string
    {
        return $this->breakfastIncluded;
    }


    public function getFinalRate(): int
    {
        return $this->finalRate;
    }


    public function getFreeCancellation(): string
    {
        return $this->freeCancellation;
    }


    public function getCurrency(): string
    {
        return $this->currency;
    }


    public function getPaymentType(): string
    {
        return $this->paymentType;
    }


    public function getRoomsLeft(): int
    {
        return $this->roomsLeft;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function roomToArray(): array
    {
        return [
            'type' => $this->getType() ,
            'breakfastIncluded' => $this->getBreakfastIncluded() ,
            'finalRate' => $this->getFinalRate(),
            'freeCancellation' => $this->getFreeCancellation(),
            'currency' => $this->getCurrency(),
            'paymentType' => $this->getPaymentType(),
            'roomsLeft' => $this->getRoomsLeft(),
            'url' => $this->getUrl()

        ];
    }


}