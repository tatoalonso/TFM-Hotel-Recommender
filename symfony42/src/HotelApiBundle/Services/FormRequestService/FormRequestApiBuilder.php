<?php


namespace App\HotelApiBundle\Services\FormRequestService;


/**
 * Class FormRequestApiBuilder
 * @package App\HotelApiBundle\Services\FormRequestService
 */
class FormRequestApiBuilder
{

    /**
     * @var FormRequestDto
     */
    private $formRequestDto;

    /**
     * FormRequestApiBuilder constructor.
     * @param FormRequestDto $formRequestDto
     */
    public function __construct (FormRequestDto $formRequestDto){

        $this->formRequestDto = $formRequestDto;

    }

    /**
     * @return array
     */
    private function getMatches():array
    {
        $arrayMatches = [];

        if(!empty($this->formRequestDto->getName())){

            $arrayMatches['name'] = $this->formRequestDto->getName();

        }

        if(!empty($this->formRequestDto->getCity())){

            $arrayMatches['name'] = $this->formRequestDto->getCity();

        }

        return $arrayMatches;

    }

    /**
     * @return array
     */
    private function getFilters()
    {

        return [
            'stars' => $this->getStars(),
            'rating'=> $this->getRating()

        ];

    }

    /**
     * @return array
     */
    private function getStars():array
    {
        if (empty($this->formRequestDto->getStars())){

            return [
                'fromStars' => "1",
                'toStars' => "5"

            ];
        }

        return [
            'fromStars' => min($this->formRequestDto->getStars()),
            'toStars' => max($this->formRequestDto->getStars())

        ];

    }

    /**
     * @return array
     */
    private function getRating():array
    {
        return [
            'fromRating' => $this->formRequestDto->getRatingMinValue(),
            'toRating' => $this->formRequestDto->getRatingMaxValue()

        ];


    }


    /**
     * @return array
     */
    private function getApi(): array
    {
        $api =[];

        $api['num_rooms'] = $this->getNumberOfRooms();
        $api['room_adults_1'] = $this->formRequestDto->getRoomOne()['adult_1'];
        $adultsInRoomTwo =$this->formRequestDto->getRoomTwo()['adult_2'];
        $childAgesOne= $this->formRequestDto->getRoomOne()['child_ages_1'];
        $childAgesTwo= $this->formRequestDto->getRoomTwo()['child_ages_2'];

        if($adultsInRoomTwo <> 0){

            $api['room_adults_2'] = $adultsInRoomTwo;
        }

        if (!empty($childAgesOne)){

            $api['room_childs_1'] = "[". implode(",", $childAgesOne)."]";

        }

        if (!empty($childAgesTwo)){

            $api['room_childs_2'] = $childAgesTwo;

        }


        $api['start_date'] = $this->formRequestDto->getStartDate();
        $api['end_date'] = $this->formRequestDto->getEndDate();




        return $api;
    }

    /**
     * @return string
     */
    private function getNumberOfRooms():string
    {
        $roomTwo = $this->formRequestDto->getRoomTwo();
        $numberOfRooms = 1;

        if ($roomTwo['adult_2'] <> 0){

            $numberOfRooms = $numberOfRooms +1;
        }

        return (string)$numberOfRooms;
    }

    /**
     * @return array
     */
    public function buildApiRequest():array
    {

        return [
            'tripType' => $this->formRequestDto->getTripType(),
            'matches' => $this->getMatches(),
            'filters'=> $this->getFilters(),
            'api'=> $this->getApi()

        ];


    }

}