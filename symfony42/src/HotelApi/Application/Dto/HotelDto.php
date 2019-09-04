<?php

namespace App\HotelApi\Application\Dto;


/**
 * Class HotelDto
 * @package App\HotelApi\Application\Dto
 */
class HotelDto
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $stars;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $city;
    /**
     * @var float
     */
    private $latitude;
    /**
     * @var float
     */
    private $longitude;
    /**
     * @var float
     */
    private $rating;
    /**
     * @var string
     */
    private $subratings;
    /**
     * @var string
     */
    private $trip_types;
    /**
     * @var string
     */
    private $path;


    /**
     * HotelDto constructor.
     * @param string $id
     * @param string $name
     * @param int $stars
     * @param string $address
     * @param string $country
     * @param string $city
     * @param float $latitude
     * @param float $longitude
     * @param float $rating
     * @param string $subratings
     * @param string $trip_types
     * @param string $path
     */
    public function  __construct(string $id, string $name, int $stars, string $address, string $country, string $city, float $latitude, float $longitude, float $rating, string $subratings, string $trip_types, string $path)
    {
        $this->id = $id;
        $this->name =$name;
        $this->stars=$stars;
        $this->address= $address;
        $this->country=$country;
        $this->city=$city;
        $this->latitude=$latitude;
        $this->longitude=$longitude;
        $this->rating=$rating;
        $this->subratings=$subratings;
        $this->trip_types=$trip_types;
        $this->path=$path;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }


    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }


    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }


    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }


    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }


    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }


    /**
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }


    /**
     * @return string
     */
    public function getSubratings(): string
    {
        return $this->subratings;
    }


    /**
     * @return string
     */
    public function getTripTypes(): string
    {
        return $this->trip_types;
    }


    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }



}