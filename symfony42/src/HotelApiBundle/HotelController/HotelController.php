<?php

namespace App\HotelApiBundle\HotelController;

use App\HotelApi\Application\Dto\RoomDto;
use App\HotelApi\Application\UseCases\CreateRoomUseCase;
use App\HotelApi\Application\UseCases\ListHotelsFilteredUseCase;
use App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Filters\FactoryFilter;
use App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Matches\SearchFuzzyMatch;
use App\HotelApiBundle\Repository\ElasticSearchRepository\Search\SearchBool;
use App\HotelApiBundle\Repository\ElasticSearchRepository\Search\SearchDecorator;
use App\HotelApiBundle\Repository\ElasticSearchRepository\Search\Sort\SortQueryTripType;
use App\HotelApiBundle\Services\FormRequestService\FormRequestApiBuilder;
use App\HotelApiBundle\Services\FormRequestService\FormRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class HotelController
 * @package App\HotelApiBundle\HotelController
 */
class HotelController extends AbstractController
{


    /**
     * @Route("/")
     */

    public function listHotels(Request $request, ListHotelsFilteredUseCase $listHotelsFilteredUseCase):JsonResponse
    {

        $jsonRequest = json_decode($request->getContent(), true);

        $queryConditions = $this->buildSearchBoolQueryConditions($jsonRequest);

        $listHotelsFiltered = $listHotelsFilteredUseCase->listHotels($queryConditions);

        return new JsonResponse($listHotelsFiltered);
    }


    /**
     * @Route("/hotelrecommender/index")
     */

    public function index(Request $request, ListHotelsFilteredUseCase $listHotelsFilteredUseCase)
    {
        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('trip_type', ChoiceType::class, [
                'choices'  => [
                    'Business' => 'Business',
                    'Couples' => 'Couples',
                    'Family' => 'Family',
                    'Friends' => 'Friends',
                    'Alone' => 'Alone',

                ],
            ])
            ->add('name', TextType::class, ['required' => false,])
            ->add('city', TextType::class, ['required' => false,])
            ->add('start_date', DateType::class)
            ->add('end_date', DateType::class)
            ->add('1', CheckboxType::class, ['required' => false,])
            ->add('2', CheckboxType::class, ['required' => false,])
            ->add('3', CheckboxType::class, ['required' => false,])
            ->add('4', CheckboxType::class, ['required' => false,])
            ->add('5', CheckboxType::class, ['required' => false,])
            ->add('Max_Value', ChoiceType::class, [
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
            ])
            ->add('Min_Value', ChoiceType::class, [
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
            ])
            ->add('adult_1', ChoiceType::class, [
                'choices'  => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',

                ],
            ])
            ->add('child_1', ChoiceType::class, [
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',

                ],
            ])
            ->add('child_ages_1', TextareaType::class,
                ['required' => false,'help' => 'Introduce child´s ages separated by comma'])
            ->add('adult_2', ChoiceType::class, [
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',

                ],
            ])
            ->add('child_2', ChoiceType::class, [
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',

                ],
            ])
            ->add('child_ages_2', TextareaType::class,
                ['required' => false,'help' => 'Introduce child´s ages separated by comma'])
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $arrayRequest=$this->handleFormRequest($data);
            $queryConditions = $this->buildSearchBoolQueryConditions($arrayRequest);
            $listHotelsFiltered = $listHotelsFilteredUseCase->listHotels($queryConditions);
            $twigHotelArray = $this->buildTwigArrayTemplate($listHotelsFiltered);
            //var_dump($twigHotelArray['hotels'][0]);die();


            return $this->render('hotel/result.html.twig',$twigHotelArray);


        }



        return $this->render('hotel/hotel.html.twig', [
            'form' => $form->createView(),
        ]);

    }


    /**
     * @param array $jsonRequest
     * @return array
     */
    private function buildSearchBoolQueryConditions(array $jsonRequest):array
     {

         $filtersArray = $jsonRequest['filters'];
         $matchesArray = $jsonRequest['matches'];
         $sortArray    = $jsonRequest['tripType'];
         $apiArray     = $jsonRequest ['api'];

         $filters  = new FactoryFilter;
         $filters = $filters ->buildFilter($filtersArray);

         $sorter  = new SortQueryTripType;
         $sorter =  $sorter->getSort($sortArray);

         $searchQuery = new SearchBool(new SearchFuzzyMatch);
         $searchQuery->setMust($matchesArray);

         $searchHotelsDecorated = new SearchDecorator($searchQuery ,$filters, $sorter);

         $queryConditions = $searchHotelsDecorated->getFilter();
         $queryConditions['api'] = $apiArray;

         return $queryConditions;

     }

    /**
     * @param array $formRequest
     * @return array
     */
    private function handleFormRequest(array $formRequest):array
     {


         $tripType= $formRequest['trip_type'];
         $name= htmlentities($formRequest['name']);
         $city= htmlentities($formRequest['city']);
         $startDate= $formRequest['start_date']->format('Y-m-d');
         $endDate= $formRequest['end_date']->format('Y-m-d');
         $stars= array($formRequest['1'],$formRequest['2'],$formRequest['3'],$formRequest['4'],$formRequest['5']);
         $minValue= $formRequest['Min_Value'];
         $maxValue= $formRequest['Max_Value'];
         $adult1 = $formRequest['adult_1'];
         $child1 = $formRequest['child_1'];
         $childAge1 = htmlentities($formRequest['child_ages_1']);
         $adult2 = $formRequest['adult_2'];
         $child2 = $formRequest['child_2'];
         $childAge2 = htmlentities($formRequest['child_ages_2']);

         $requestDto = new FormRequestDto($tripType,$name,$city,$startDate,$endDate,$stars,$minValue,$maxValue,$adult1,$child1,$childAge1,$adult2,$child2,$childAge2);

         //$requestDto = new FormRequestDto($formRequest);
         $formRequestApiBuilder = new FormRequestApiBuilder($requestDto);
         return $formRequestApiBuilder->buildApiRequest();



     }

    /**
     * @param array $listHotelsFiltered
     * @return array
     */
    private function buildTwigArrayTemplate(array $listHotelsFiltered):array
     {


        foreach ($listHotelsFiltered as $key=>$hotel){

            $rooms = $this->buildRoomArray($hotel['api']['room_types'][0]);

            $hotelFiltered =[

                    'name' => $hotel['elastic_search']['name'],
                    'stars' => $hotel['elastic_search']['stars'],
                    'address' => $hotel['elastic_search']['address'],
                    'city' => $hotel['elastic_search']['city'],
                    'rating' => $hotel['elastic_search']['rating'],
                    'img' => $hotel['elastic_search']['path'],
                    'subratings' =>$hotel['elastic_search']['subratings'],
                    'rooms' => $rooms

            ];

            $twigHotelArray[] =  $hotelFiltered ;

        }


       if (empty($twigHotelArray)){
             return ['hotels' => []];
         }

         return ['hotels' => $twigHotelArray ];

     }

     private function buildRoomArray(array $roomsTypes): array
     {


         foreach ($roomsTypes as $key => $room){


             $type =key($room);
             $roomDto = new RoomDto($type,$room[$type]['breakfast_included'],$room[$type]['final_rate'],$room[$type]['free_cancellation'],$room[$type]['currency'],$room[$type]['payment_type'],$room[$type]['rooms_left'],$room[$type]['url'] );
             $createRoomUseCase = new CreateRoomUseCase();
             $roomObject = $createRoomUseCase->createRoom($roomDto);
             $arrayRooms[] = $roomObject->roomToArray();
         }


         return $arrayRooms;

     }



}