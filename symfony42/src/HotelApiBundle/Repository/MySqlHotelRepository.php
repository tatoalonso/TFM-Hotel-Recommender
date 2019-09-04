<?php

namespace App\HotelApiBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\HotelApi\Domain\Repository\HotelRepository;
use App\HotelApi\Domain\Hotel;
use Exception;


/**
 * Class MySqlHotelRepository
 * @package App\HotelApiBundle\Repository
 */
class MySqlHotelRepository extends EntityRepository  implements HotelRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * MySqlHotelRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return Hotel[] Returns an array of Hotel objects
     */

    public function findAll():array
    {
        try{

            $query =  $this->em->createQuery( 'SELECT h
        FROM App\HotelApi\Domain\Hotel h
        ');

            return $query->execute();

        } catch (Exception $e) {

            return  $array = ["error" => $e->getMessage()];

        }
    }

    /**
     * @param Hotel $hotel
     * @throws Exception
     */
    public function saveHotel(Hotel $hotel): void
    {
        try {
            $this->em->persist($hotel);
            $this->em->flush();

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }
    }

    /**
     * @param int $hotelId
     * @return Hotel
     * @throws Exception
     */
    public function findHotelById(int $hotelId): Hotel
    {

        $hotel = $this->em->getRepository(Hotel::class)->findOneBy(['id' => $hotelId]);

        if (is_null($hotel)){

            throw new Exception('Se produjo un error');
        }

        return $hotel;

    }

    /**
     * @param int $idHotel
     * @throws Exception
     */
    public function deleteHotel(int $idHotel): void
    {
        try{

            $hotel = $this->em->getReference(Hotel::class, $idHotel);
            $this->em->remove($hotel);
            $this->em->flush();


        } catch (Exception $e) {

            throw new Exception('Se produjo un error');

        }
    }





}