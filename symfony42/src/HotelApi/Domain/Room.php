<?php


namespace App\HotelApi\Domain;


/**
 * Class Room
 * @package App\HotelApi\Domain
 */
class Room
{

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $breakfastIncluded;

    /**
     * @var int
     */
    private $finalRate;

    /**
     * @var string
     */
    private $freeCancellation;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $paymentType;

    /**
     * @var int
     */
    private $roomsLeft;

    /**
     * @var string
     */
    private $url;


    /**
     * Room constructor.
     * @param string $type
     * @param string $breakfastIncluded
     * @param int $finalRate
     * @param string $freeCancellation
     * @param string $currency
     * @param string $paymentType
     * @param int $roomsLeft
     * @param string $url
     */
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

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }


    /**
     * @return string
     */
    public function getBreakfastIncluded(): string
    {
        return $this->breakfastIncluded;
    }


    /**
     * @return int
     */
    public function getFinalRate(): int
    {
        return $this->finalRate;
    }


    /**
     * @return string
     */
    public function getFreeCancellation(): string
    {
        return $this->freeCancellation;
    }


    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }


    /**
     * @return string
     */
    public function getPaymentType(): string
    {
        return $this->paymentType;
    }


    /**
     * @return int
     */
    public function getRoomsLeft(): int
    {
        return $this->roomsLeft;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return array
     */
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