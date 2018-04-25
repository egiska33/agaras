<?php

namespace App\Http\Services;

use App\Seller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SpecialVatService
{
    protected $seller;

    protected $formParams;

    protected $requestData;

    public function __construct(Seller $seller, $requestData)
    {
        $this->seller = $seller;
        $this->requestData = $this->handleAndSetRequestData($requestData);
        $this->formParams = $this->prepareFormParams();
    }

    public function process()
    {
        return $this->handleRequest();
    }

    private function handleRequest()
    {
        $client = new Client();

        $req = $client->request('POST', $this->requestData['link'], [
            'headers' => $this->getHeaders(),
            'form_params' => $this->formParams,
        ]);

        return $this->handleResponse($req->getBody());
    }

    private function handleResponse($response)
    {
        $html = new \Htmldom($response);

        if($html->find('#farmers_no_result')) {
            return false;
        }
        
        $html = $html->find('.eskis-result-table', 0);

        foreach ($html->find('tr') as $tr) {
            $label = $tr->find('.eskis-result-field-label', 0);

            if(!$label) {
                continue;
            }

            if(preg_match('/Kodas:/im', $label->innertext)) {
                return trim($label->next_sibling()->innertext);
            }
        }

        return false;
    }

    private function handleAndSetRequestData($params)
    {
        $html = new \Htmldom($params);

        $formLink = false;
        foreach ($html->find('#_farmersvatcompensationportlet_WAR_eskisliferayportlet_fm') as $link) {
          $formLink = $link->action;
        }

        if(!$formLink) {
            return false;
        }

        $formDate = false;
        foreach ($html->find('input[name=_farmersvatcompensationportlet_WAR_eskisliferayportlet_formDate]') as $date) {
            $formDate = $date->value;
        }

        if(!$formDate) {
            return false;
        }

        return array(
            'link'      => htmlspecialchars_decode($formLink),
            'date'      => $formDate,
        );
    }

    private function getHeaders()
    {
        return [
            'Accept'            => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Encoding'   => 'gzip, deflate',
            'Accept-Language'   => 'lt,en-US;q=0.8,en;q=0.6,ru;q=0.4,pl;q=0.2,de;q=0.2,ja;q=0.2',
            'Cache-Control'     => 'no-cache',
            'Connection'        => 'keep-alive',
            'Content-Type'      => 'application/x-www-form-urlencoded',
            'Pragma'            => 'no-cache',
            'Referer'           => 'http://www.vmi.lt/cms/ukininkai-kuriems-taikoma-kompensacinio-pvm-tarifo-schema1',
            'User-Agent'        => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.89 Safari/537.36',
        ];
    }

    private function prepareFormParams()
    {
        return [
            '_farmersvatcompensationportlet_WAR_eskisliferayportlet_formDate'       => $this->requestData['date'],
            '_farmersvatcompensationportlet_WAR_eskisliferayportlet_searchfield'    => 'asm_kodas',
            '_farmersvatcompensationportlet_WAR_eskisliferayportlet_asm_kodas'      => $this->seller->code,
            '_farmersvatcompensationportlet_WAR_eskisliferayportlet_kodas'          => '',
        ];
    }
}