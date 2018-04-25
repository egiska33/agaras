<?php

namespace App\Http\Services;

use App\Seller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class VatService
{
	protected $seller;

	protected $requestData;

	protected $captcha;

	protected $requestType;

	protected $formParams;

    const RATE = [
        'none' => 0,
        'exemption' => 6,
        'full' => 21, 
    ];

    public function __construct(Seller $seller, $requestData, $captcha)
    {
    	$this->seller = $seller;
    	$this->requestData = $this->handleParams($requestData);
    	$this->captcha = $captcha;
    	$this->handleRequestType();
    	$this->formParams = $this->getFormParams();
    }

    public function process()
    {
    	return $this->getVatAnswer();
    }

    public function getRequestType()
    {
        return $this->requestType;
    }

    private function getVatAnswer()
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

        if($html->find('#taxPayersInvalidCaptcha')) {
            return false;
        }

        // Check if tax payer exists
        if($html->find('#taxPayersNoResult')) {
            return [
                'rate' => self::RATE['none'],
                'vatCode' => ''
            ];
        }

        if($this->requestType == 'physical') {
            return $this->handlePhysicalResponse($html);
        }

        if($this->requestType == 'juridical') {
            return $this->handleJuridicalResponse($html);
        }
        
        return false;
    }

    private function handlePhysicalResponse($html)
    {
        $html = $html->find('#_taxespayersportlet_WAR_eskisliferayportlet_results', 0);

        $rate = self::RATE['none'];
        $vatCode = '';
        foreach ($html->find('tbody > tr') as $tr) {
            $label = $tr->find('.eskis-result-field-label', 0);

            if(!$label) {
                continue;
            }

            if(preg_match('/Ar PVM mokėtojas/im', $label->innertext)) {
                if(preg_match('/Taip/im', $tr->find('.eskis-result-field', 0)->innertext)) {
                    $rate = self::RATE['full'];
                }
            }

            if($rate == self::RATE['full'] && preg_match('/PVM mokėtojo kodas/im', $label->innertext)) {
                $vatCode = trim($label->next_sibling()->innertext);
            }
        }

        if(preg_match('/Ūkininkas, kuriam taikoma PVM kompensacinio tarifo schema/im', $html->innertext)) {
            $rate = self::RATE['exemption'];
        }

        return [
            'rate' => $rate,
            'vatCode' => $vatCode,
        ];
    }

    private function handleJuridicalResponse($html)
    {
        $html = $html->find('#_taxespayersportlet_WAR_eskisliferayportlet_results', 0);

        $rate = self::RATE['none'];
        $hasExemption = false;
        $vatCode = '';
        foreach ($html->find('tbody > tr') as $tr) {
            $label = $tr->find('.eskis-result-field-label', 0);

            if(!$label) {
                continue;
            }

            if(preg_match('/Ar PVM mokėtojas/im', $label->innertext)) {
                if(preg_match('/Taip/im', $tr->find('.eskis-result-field', 0)->innertext)) {
                    $rate = self::RATE['full'];
                }
            }

            if(preg_match('/Priklausymas grupėms/im', $label->innertext)) {
                if(preg_match('/Taikoma speciali PVM apmokestinamojo momento nustatymo tvarka/im', $tr->find('.eskis-result-field', 0)->innertext)) {
                    $hasExemption = true;
                }
            }

            if($rate == self::RATE['full'] && preg_match('/PVM mokėtojo kodas/im', $label->innertext)) {
                $vatCode = trim($label->next_sibling()->innertext);
            }
        }

        return [
            'rate'          => $rate,
            'hasExemption'  => $hasExemption,
            'vatCode'       => $vatCode,
        ];
    }

    private function handleRequestType()
    {
    	if(strlen($this->seller->code) == 11) {
    		$this->requestType = 'physical';
    	}

    	if(strlen($this->seller->code) == 9) {
    		$this->requestType = 'juridical';
    	}
    }

    private function handleParams($params)
    {
    	$html = new \Htmldom($params);

        $formLink = false;
        foreach ($html->find('#_taxespayersportlet_WAR_eskisliferayportlet_fm') as $link) {
          $formLink = $link->action;
        }

        if(!$formLink) {
            return false;
        }

        $formDate = false;
        foreach ($html->find('input[name=_taxespayersportlet_WAR_eskisliferayportlet_formDate]') as $date) {
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
            'Referer'           => 'http://www.vmi.lt/cms/informacija-apie-mokesciu-moketojus',
            'User-Agent'        => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.89 Safari/537.36',
        ];
    }

    private function getFormParams()
    {
    	$data = array();

    	if($this->requestType == 'physical') {
    		$mainFields = [
		        '_taxespayersportlet_WAR_eskisliferayportlet_physical_search_type'  => 'person_code',
		        '_taxespayersportlet_WAR_eskisliferayportlet_physical_title'        => $this->seller->name,
		        '_taxespayersportlet_WAR_eskisliferayportlet_physical_code'         => $this->seller->code,
		        '_taxespayersportlet_WAR_eskisliferayportlet_juridical_title'       => '',
		        '_taxespayersportlet_WAR_eskisliferayportlet_juridical_code'        => '',
    		];
    	} else {
    		$mainFields = [
		        '_taxespayersportlet_WAR_eskisliferayportlet_physical_search_type'  => '',
		        '_taxespayersportlet_WAR_eskisliferayportlet_physical_title'        => '',
		        '_taxespayersportlet_WAR_eskisliferayportlet_physical_code'         => '',
		        '_taxespayersportlet_WAR_eskisliferayportlet_juridical_title'       => '',
		        '_taxespayersportlet_WAR_eskisliferayportlet_juridical_code'        => $this->seller->code,
    		];
    	}

    	$data = [
	        '_taxespayersportlet_WAR_eskisliferayportlet_juridical_vatcode'     => '',
	        '_taxespayersportlet_WAR_eskisliferayportlet_group_codes'           => '',
	    	'_taxespayersportlet_WAR_eskisliferayportlet_formDate'              => $this->requestData['date'],
	        '_taxespayersportlet_WAR_eskisliferayportlet_searchfield'           => $this->requestType,
	        '_taxespayersportlet_WAR_eskisliferayportlet_captchaText'           => $this->captcha,	
        ];

        return array_merge($data, $mainFields);
    }
}
