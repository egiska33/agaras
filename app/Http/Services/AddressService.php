<?php

namespace App\Http\Services;

use App\Seller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AddressService
{
    public $response = false;

    protected $seller;

    protected $guzzle;

    public function __construct(Seller $seller)
    {
        $this->guzzle = new Client();
        $this->seller = $seller;
    }

    public function getPostCode()
    {
        $address = $this->getAddress();

        if (!$address['success'] || empty($address['total'])) {
            return false;
        }

        return $address['data'][0]['post_code'];
    }

    public function getAddress()
    {
        $req = $this->guzzle->request('GET', 'https://postit.lt/data/v2/', [
            'query' => $this->prepareParams()
        ]);

        $res = $req->getBody();

        return $this->handleResponse($res);
    }

    private function handleResponse($response)
    {
        $response = json_decode($response, true);

        $this->response = $response;

        return $this->response;
    }

    private function prepareParams()
    {
        $address = $this->resolveAddress($this->seller->address);

        $address['limit'] = 1;

        return $address;
    }

    private function resolveAddress($address)
    {
        $sanitizedAddress = $this->sanitizeAddress($address);

        if (is_array($sanitizedAddress)) {
            return [
                'municipality' => $sanitizedAddress[0],
                'city' => $sanitizedAddress[2],
            ];
        }

        return [
            'address' => $address
        ];
    }

    private function sanitizeAddress($address)
    {
        if(!preg_match('/sen./im', $address)) {
            return $address;
        }

        $temp = explode(',', $address);

        if(count($temp) != 3) {
            return $address;
        }

        return $temp;
    }
}