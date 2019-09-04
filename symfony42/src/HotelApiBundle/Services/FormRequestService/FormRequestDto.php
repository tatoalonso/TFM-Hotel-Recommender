<?php

namespace App\HotelApiBundle\Services\FormRequestService;


/**
 * Class FormRequestDto
 * @package App\HotelApiBundle\Services\FormRequestService
 */
class FormRequestDto
{

    /**
     * @var string
     */
    private $trip_type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $startDate;

    /**
     * @var string
     */
    private $endDate;

    /**
     * @var array
     */
    private $stars;

    /**
     * @var string
     */
    private $ratingMinValue;

    /**
     * @var string
     */
    private $ratingMaxValue;

    /**
     * @var array
     */
    private $roomOne;

    /**
     * @var array
     */
    private $roomTwo;



/*
    public function __construct (array $arrayFormRequest)
    {
        $this->trip_type= $arrayFormRequest['trip_type'];
        $this->name= $arrayFormRequest['name'];
        $this->city= $arrayFormRequest['city'];
        $this->startDate= $arrayFormRequest['start_date']->format('Y-m-d');
        $this->endDate= $arrayFormRequest['end_date']->format('Y-m-d');
        $this->stars=$this->buildArrayStars($arrayFormRequest['1'],$arrayFormRequest['2'],$arrayFormRequest['3'],$arrayFormRequest['4'],$arrayFormRequest['5']);
        $this->ratingMinValue= $arrayFormRequest['Min_Value'];
        $this->ratingMaxValue= $arrayFormRequest['Max_Value'];
        $this->roomOne = ['adult_1'=>$arrayFormRequest['adult_1'],
            'child_1'=>$arrayFormRequest['child_1'],
            'child_ages_1'=>$this->buildArrayChildAges($arrayFormRequest['child_ages_1'])


        ];

        $this->roomTwo = ['adult_2'=>$arrayFormRequest['adult_2'],
            'child_2'=>$arrayFormRequest['child_2'],
            'child_ages_2'=>$this->buildArrayChildAges($arrayFormRequest['child_ages_2'])

        ];


    } */

    /**
     * FormRequestDto constructor.
     * @param string $tripType
     * @param string|null $name
     * @param string|null $city
     * @param string $startDate
     * @param string $endDate
     * @param array $arrayStars
     * @param string $minValue
     * @param string $maxValue
     * @param string $adult1
     * @param string $child1
     * @param string|null $childAge1
     * @param string $adult2
     * @param string $child2
     * @param string|null $childAge2
     */
    public function __construct (string $tripType, string $name=null , string $city=null, string $startDate, string $endDate, array $arrayStars, string $minValue, string $maxValue, string $adult1, string $child1, string $childAge1=null, string $adult2, string $child2, string $childAge2=null)
    {
        $this->trip_type= $tripType;
        $this->name= $name;
        $this->city= $city;
        $this->startDate= $startDate;
        $this->endDate= $endDate;
        $this->stars=$this->buildArrayStars($arrayStars);
        $this->ratingMinValue= $minValue;
        $this->ratingMaxValue= $maxValue;
        $this->roomOne = ['adult_1'=>$adult1,
            'child_1'=>$child1,
            'child_ages_1'=>$this->buildArrayChildAges($childAge1)


        ];

        $this->roomTwo = ['adult_2'=>$adult2,
            'child_2'=>$child2,
            'child_ages_2'=>$this->buildArrayChildAges($childAge2)

        ];


    }


    /**
     * @param string|null $childAges
     * @return array
     */
    private function buildArrayChildAges(?string $childAges):array
    {

        $arrayChildAges = explode(",",$childAges);

        if (strlen($arrayChildAges[0]) == 0){

            return [];
        }


        foreach ($arrayChildAges as $key =>$childAgeValue){

            $arrayChildAges[$key] = (int)$childAgeValue;
        }



        return $arrayChildAges;

    }

    /**
     * @param array $arrayStars
     * @return array
     */
    private function buildArrayStars(array $arrayStars):array
    {
        $arrayStarsBuild = [];

        foreach ($arrayStars as $key=> $value){

            if(!empty($value)){

                $arrayStarsBuild[$key] = $key;

            }


        }

        return  $arrayStarsBuild;




    }
   /* private function buildArrayStars(string $star1,string $star2,string $star3,string $star4,string $star5) :array{

        $arrayStars = [];

        if(!empty($star1)){

            $arrayStars['1'] = 1;

        }
        if(!empty($star2)){

            $arrayStars['2'] = 2;

        }
        if(!empty($star3)){

            $arrayStars['3'] = 3;

        }
        if(!empty($star4)){

            $arrayStars['4'] = 4;

        }
        if(!empty($star5)){

            $arrayStars['5'] = 5;

        }

        return $arrayStars;

    } */


    /**
     * @return string|null
     */
    public function getTripType(): ?string
    {
        return $this->trip_type;
    }


    /**
     * @return string|null
     */
    public function getName():?string
    {
        return $this->name;
    }


    /**
     * @return string|null
     */
    public function getCity():?string
    {
        return $this->city;
    }


    /**
     * @return string|null
     */
    public function getStartDate():?string
    {
        return $this->startDate;
    }


    /**
     * @return string|null
     */
    public function getEndDate():?string
    {
        return $this->endDate;
    }


    /**
     * @return array
     */
    public function getStars(): array
    {
        return $this->stars;
    }


    /**
     * @return string|null
     */
    public function getRatingMinValue():?string
    {
        return $this->ratingMinValue;
    }


    /**
     * @return string|null
     */
    public function getRatingMaxValue():?string
    {
        return $this->ratingMaxValue;
    }


    /**
     * @return array
     */
    public function getRoomOne(): array
    {
        return $this->roomOne;
    }


    /**
     * @return array
     */
    public function getRoomTwo(): array
    {
        return $this->roomTwo;
    }


}