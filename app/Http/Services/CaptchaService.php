<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CaptchaService
{

	protected $capturedCaptcha = 'uploads/capture.jpg';

	/**
     * If equals to true, we don't use captcha service and return dummy string
     */
	public $sandbox = false;

    public function __construct($sandbox = false)
    {
    	if($sandbox) {
    		$this->sandbox = true;
    	}
    }

	public function process()
	{
		if($this->sandbox) {
    		return '4465';
    	}

		if(!$requestId = $this->sendCaptcha()) {
			return false;
		}

		return $this->getSolvedCaptcha($requestId);
	}


	/**
     * Send captcha image and get solved captha as a string
     * @return string
     */
    public function sendCaptcha()
    {
        $send = new Client();

        $req = $send->request('POST', 'http://2captcha.com/in.php', [
            'form_params' => [
                'key'           => env('CAPTCHA_SOLVER_KEY'),
                'method'        => 'base64',
                'body'          => $this->getCaptchaImg(),
                'numeric'       => 1,
                'min_len'       => 4,
                'max_len'       => 4,
                'json'          => 1,
            ]
        ]);

        $res = json_decode($req->getBody());

        // We can't proceed since something went wrong
        if($res->status != 1) {
            return false;
        }

        return $res->request;
    }

    public function getSolvedCaptcha($requestId)
    {
        ini_set('max_execution_time', 300);

        $get = new Client();

		$i = 0;

        do {
            $req = $get->request('GET', 'http://2captcha.com/res.php?key='. env('CAPTCHA_SOLVER_KEY') .'&action=get&json=1&id='. $requestId);
            $answer = json_decode($req->getBody());

			$i++;

			\Log::info('Iteracija: '.$i);

			if($i == 100) return false;

			sleep(1);
        } while ($answer->status == 0);
        
        return (string)$answer->request;
    }

    public function getCaptchaImg()
    {
        $type = pathinfo($this->capturedCaptcha, PATHINFO_EXTENSION);
        $data = file_get_contents($this->capturedCaptcha);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}
