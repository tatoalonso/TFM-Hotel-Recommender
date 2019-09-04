<?php


namespace App\HotelApiBundle\Commands;



use App\HotelApi\Application\Dto\HotelDto;
use App\HotelApi\Application\UseCases\RegisterNewHotelUseCase;
use App\HotelApiBundle\Services\CsvFileHandler;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SplFileInfo;

/**
 * Class RegisterMysqlHotelsCommand
 * @package App\HotelApiBundle\Commands
 */
class RegisterMysqlHotelsCommand extends Command
{

    /**
     *
     */
    const DIRECTORY = './HotelFiles/';

    /**
     * @var RegisterNewHotelUseCase
     */
    private $newHotelUseCase;

    /**
     * RegisterMysqlHotelsCommand constructor.
     * @param RegisterNewHotelUseCase $newHotelUseCase
     */
    public function __construct(RegisterNewHotelUseCase $newHotelUseCase)
    {
        parent::__construct();
        $this->newHotelUseCase = $newHotelUseCase;
    }

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName("hotel:create")
            ->setDescription("Register new Hotels")
            ->addArgument(
                "FileName"
                , InputArgument::REQUIRED
                , "The File name");

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $FileName = filter_var($input->getArgument('FileName') , FILTER_SANITIZE_STRING);
        $file = self::DIRECTORY.$FileName;
        $splFileInfo = new SplFileInfo($file);
        $csvFileHandler = new CsvFileHandler($splFileInfo);

        try {

            $csvContentArray = $csvFileHandler->getFileContent();


            foreach ($csvContentArray as $key =>  $value ) {

                $id =intval(filter_var($csvContentArray[$key]["id_property"],FILTER_SANITIZE_STRING));
                $name =filter_var($csvContentArray[$key]["name"],FILTER_SANITIZE_STRING);
                $stars = intval(filter_var($csvContentArray[$key]["stars"],FILTER_SANITIZE_STRING));
                $address = filter_var($csvContentArray[$key]["address"],FILTER_SANITIZE_STRING);
                $country = filter_var($csvContentArray[$key]["country"],FILTER_SANITIZE_STRING);
                $city = filter_var($csvContentArray[$key]["city"],FILTER_SANITIZE_STRING);
                $latitude = floatval(filter_var($csvContentArray[$key]["latitude"],FILTER_SANITIZE_STRING));
                $longitude = floatval(filter_var($csvContentArray[$key]["longitude"],FILTER_SANITIZE_STRING));
                $rating = floatval(filter_var($csvContentArray[$key]["rating"],FILTER_SANITIZE_STRING));
                $subratings = $csvContentArray[$key]["subratings"];
                $trip_types = $csvContentArray[$key]["trip_types"];
                $path = filter_var($csvContentArray[$key]["path"],FILTER_SANITIZE_STRING);

                $hotelDto = new HotelDto($id,$name,$stars,$address,$country,$city,$latitude,$longitude,$rating,$subratings,$trip_types,$path);


                $this->newHotelUseCase->registerHotel($hotelDto);

            }

            $output->writeln("Hotels added!");

        } catch (Exception $e) {

            echo 'Error: ',  $e->getMessage(), "\n";
        }



    }


}