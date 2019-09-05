<?php

namespace App\HotelApi\Domain;

use mysql_xdevapi\Exception;

/**
 * Class Hotel
 * @package App\HotelApi\Domain
 */
class Hotel
{
    /**
     *
     */
    const  MAX_NAME_LENGTH_2 = 2;
    /**
     *
     */
    const  MAX_NAME_LENGTH_70 = 70;
    /**
     *
     */
    const  MAX_NAME_LENGTH_100 = 100;
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
     * Hotel constructor.
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
    public function __construct(string $id, string $name, int $stars, string $address, string $country, string $city, float $latitude, float $longitude, float $rating, string $subratings, string $trip_types, string $path)
    {

        $this->id = $id;
        $this->name =$this->validateName($name);
        $this->stars=$this->validateStars($stars);
        $this->address= $this->validateAddress($address);
        $this->country=$this->validateCountry($country);
        $this->city=$this->validateCity($city);
        $this->latitude=$latitude;
        $this->longitude=$longitude;
        $this->rating=$this->validateRating($rating);
        $this->subratings=$subratings;
        $this->trip_types=$trip_types;
        $this->path=$path;

    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Hotel
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return int|null
     */
    public function getStars(): ?int
    {
        return $this->stars;
    }

    /**
     * @param int $stars
     * @return Hotel
     */
    public function setStars(int $stars): self
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Hotel
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param int $country
     * @return Hotel
     */
    public function setCountry(int $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Hotel
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param $latitude
     * @return Hotel
     */
    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param $longitude
     * @return Hotel
     */
    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param $rating
     * @return Hotel
     */
    public function setRating($rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubratings()
    {
        return $this->subratings;
    }

    /**
     * @param $subratings
     * @return Hotel
     */
    public function setSubratings($subratings): self
    {
        $this->subratings = $subratings;

        return $this;
    }

    /**
     * @return string
     */
    public function getTripTypes()
    {
        return $this->trip_types;
    }

    /**
     * @param $trip_types
     * @return Hotel
     */
    public function setTripTypes($trip_types): self
    {
        $this->trip_types = $trip_types;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Hotel
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return array
     */
    public function hotelToArray(): array
    {
        return [
            'id' => $this->getid() ,
            'name' => $this->getName() ,
            'stars' => $this->getStars(),
            'address' => $this->getAddress(),
            'country' => $this->getCountry(),
            'city' => $this->getCity(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'rating' => $this->getRating(),
            'subratings' => $this->arrayByCategory(json_decode($this->getSubratings(),true)),
            'trip_types' => $this->arrayByCategory(json_decode($this->getTripTypes(),true)),
            'path' => $this->getPath()

        ];
    }

    /**
     * @param array $property
     * @return array
     */
    public function arrayByCategory(array $property):array
   {

       $keys = array_column($property, 'localized_name');

       foreach ($property as $key => $value) {

           unset($property[$key]['localized_name']);
           $property[$key]['value'] = $this->stringToFloat($property[$key]['value']);

       }

       return array_combine($keys,$property);
   }


    /**
     * @param string $value
     * @return float
     */
    public function stringToFloat(string $value ): float
    {
        return floatval($value);
    }

    /**
     * @param string $name
     * @return string
     */
    private function validateName(string $name): string
    {

        $name = filter_var($name, FILTER_SANITIZE_STRING);

        if ($name === '') {

            throw new Exception('name can not be empty');

        }

        $nameLength = mb_strlen($name);

        if ($nameLength > self::MAX_NAME_LENGTH_70) {

            throw new Exception('name too long');

        }

        return $name;

    }

    /**
     * @param int $stars
     * @return int
     */
    private function validateStars(int $stars): int
    {
        if ($stars > 5 || $stars < 1  ){

            throw new Exception('Invalid Star value');

        }

        return $stars;

    }

    /**
     * @param float $rating
     * @return float
     */
    private function validateRating(float $rating): float
    {
        if ($rating > 5 || $rating < 1  ){

            throw new Exception('Invalid Rating value');

        }

        return $rating;

    }


    /**
     * @param string $address
     * @return string
     */
    private function validateAddress(string $address): string
    {

        $address = filter_var($address, FILTER_SANITIZE_STRING);

        if ($address === '') {

            throw new Exception('address can not be empty');

        }

        $addressLength = mb_strlen($address);

        if ($addressLength > self::MAX_NAME_LENGTH_100) {

            throw new Exception('address too long');

        }

        return $address;

    }

    /**
     * @param string $country
     * @return string
     */
    private function validateCountry(string $country): string
    {

        $countryLength = mb_strlen($country);

        if ($countryLength <> self::MAX_NAME_LENGTH_2) {

            throw new Exception('Invalid country Length');

        }

        return $country;

    }

    /**
     * @param string $city
     * @return string
     */
    private function validateCity(string $city): string
    {

        $city = filter_var($city, FILTER_SANITIZE_STRING);

        if ($city === '') {

            throw new Exception('city can not be empty');

        }

        $cityLength = mb_strlen($city);

        if ($cityLength > self::MAX_NAME_LENGTH_70) {

            throw new Exception('city too long');

        }

        return $city;

    }


}
