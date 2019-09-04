<?php


namespace App\HotelApiBundle\Services\ApiService\ApiTypes;


use App\HotelApiBundle\Services\ApiService\GuzzleApiRequest;

/**
 * Class GuzzleApiStayForLong
 * @package App\HotelApiBundle\Services\ApiService\ApiTypes
 */
class GuzzleApiStayForLong extends GuzzleApiRequest
{

    /**
     *
     */
    const URI = 'http://api-public.stayforlong.com/trivago/hotel_availability';
    /**
     *
     */
    const AUTH = ['test', '--sfltest--'];
    /**
     *
     */
    const API_VERSION = '4';
    /**
     *
     */
    const LANG = 'es_ES';
    /**
     *
     */
    const RATE_MODEL = 'AI';
    /**
     *
     */
    const CURRENCY = 'EUR';


    /**
     * @param array $parameters
     * @return array
     */
    public function getOptions(array $parameters):array
    {
        return  $options = [
            'auth'        => $this->getAuth(),
            'headers'     => $this->getHeaders(),
            'form_params' => $this->getFormsParams($parameters)
        ];
    }

    /**
     * @return string
     */
    public function getUri():string
    {
        return self::URI;
    }

    /**
     * @return array
     */
    private function getAuth():array
    {
        return self::AUTH;
    }

    /**
     * @return array
     */
    private function getHeaders():array
    {
        return [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
    }

    /**
     * @param $parameters
     * @return array
     */
    private function getFormsParams($parameters):array
    {
        $paramsConst =  [
        'api_version' => self::API_VERSION,
        'lang' => self::LANG,
        'rate_model' => self::RATE_MODEL,
        'currency' => self::CURRENCY

        ];

        return array_merge($paramsConst,$parameters);


    }

}

