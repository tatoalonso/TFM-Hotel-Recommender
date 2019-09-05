<?php


namespace App\HotelApiBundle\Commands;


use App\HotelApi\Application\Dto\HotelDto;
use App\HotelApi\Application\UseCases\ListHotelByIdUseCase;
use App\HotelApi\Application\UseCases\ListHotelsUseCase;
use App\HotelApi\Application\UseCases\MappingHotelsUseCase;
use App\HotelApiBundle\Repository\MySqlHotelRepository;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MappingHotels
 * @package App\HotelApiBundle\Commands
 */
class MappingHotels extends Command
{

    /**
     * @var ListHotelsUseCase
     */
    private $listHotelsUseCase;

    /**
     * @var MappingHotelsUseCase
     */
    private $mappingHotelsUseCase;

    /**
     * MappingHotels constructor.
     * @param ListHotelsUseCase $listHotelsUseCase
     * @param MappingHotelsUseCase $mappingHotelsUseCase
     */
    public function __construct(ListHotelsUseCase $listHotelsUseCase, MappingHotelsUseCase  $mappingHotelsUseCase)
    {
        parent::__construct();
        $this->listHotelsUseCase = $listHotelsUseCase;
        $this->mappingHotelsUseCase = $mappingHotelsUseCase;
    }

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName("hotel:mapping")
            ->setDescription("Map out all Hotels");

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $arrayHotels = $this->listHotelsUseCase->listAll();

        $hotel = $arrayHotels[111];

        var_dump($hotel);

        $this->mappingHotelsUseCase->mapHotel($hotel);

        /*try {

            foreach ($arrayHotels as  $hotel) {

                $this->mappingHotelsUseCase->mapHotel($hotel);
            }

        } catch (Exception $e) {

            throw new Exception($e->getMessage().$hotel->getId());

        }*/



        //$subratings = $hotel->hotelToArray();


        /*var_dump($subratings);

        $keys = array_column($subratings, 'localized_name');
        foreach ($subratings as $key => $value) {
            unset($subratings[$key]['localized_name']);
        }

        $arrayguay=array_combine($keys,$subratings);*/

       /* $subratings=$subratings['trip_types'] ;
        $subratings = $subratings['Family']['value'];
        var_dump($subratings);*/




       // $this->mappingHotelsUseCase->mapHotel($hotel);

        $output->writeln("Hotels mapped!");

    }


}