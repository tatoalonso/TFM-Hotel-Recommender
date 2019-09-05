<?php


namespace App\HotelApiBundle\Services\ApiService;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;


/**
 * Class GuzzleApiRequest
 * @package App\HotelApiBundle\Services\ApiService
 */
abstract class GuzzleApiRequest implements ApiRequestInterface
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @return string
     */
    protected abstract function getUri():string;

    /**
     * @param array $parameters
     * @return array
     */
    protected abstract function getOptions(array $parameters):array ;

    /**
     * GuzzleApiRequest constructor.
     */
    public function __construct()
    {
        $this->client = new Client();

    }

    /**
     * @param array $parameters
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(array $parameters): array
    {
        try {


            $response = $this->client->request(
                'POST',
                $this->getUri(),
                $this->getOptions($parameters));


            return json_decode($response->getBody(), true);

        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());


            }
            return [];
        }

    }

}

