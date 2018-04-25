<?php

namespace App\Http\Services;

use JonnyW\PhantomJs\Client as Phantom;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;

class CaptureService
{
    /**
     * Where to store screenshoot of captcha
     * @var string
     */
    protected $pathForCapture;

    /**
     * Where custom phantom scripts is stored
     * @var string
     */
    protected $pathToPhantomScripts;

    /**
     * Where captcha binary is stored
     * @var string
     */
    protected $pathToPhantomBinary;

    protected $mode;

    public $response;

    const STATUSES = ['200', '301', '303'];

    const LINKS = [
        'capture' => 'http://www.vmi.lt/cms/informacija-apie-mokesciu-moketojus',
        'get'     => 'http://www.vmi.lt/cms/ukininkai-kuriems-taikoma-kompensacinio-pvm-tarifo-schema1',
    ];

    public function __construct($mode = 'capture')
    {
        $this->mode = $mode;
        $this->pathForCapture = public_path() . '/uploads/capture.jpg';
        $this->pathToPhantomScripts = base_path() . '/resources/assets/js/components';
        $this->pathToPhantomBinary = base_path() . '/vendor/jakoch/phantomjs/bin/phantomjs';
    }

    public function process()
    {
        $this->sendRequest();

        if(!in_array($this->response->getStatus(), self::STATUSES)) {
            return false;
        }

        if ($this->mode == 'capture') {
            return $this->response->getContent();
        }

        return $this->cleanResponse($this->response->getContent());
    }

    /**
     * Get captcha screenshot from opened page and parse a link from a page
     */
    private function sendRequest()
    {
        if($this->mode == 'capture') {
            $serviceContainer = ServiceContainer::getInstance();

            $procedureLoader = $serviceContainer
                                ->get('procedure_loader_factory')
                                ->createProcedureLoader($this->pathToPhantomScripts);
        }

        $client = Phantom::getInstance();

        $client->getEngine()->setPath($this->pathToPhantomBinary);

        if($this->mode == 'capture') {
            $client->getProcedureCompiler()->clearCache();

            $client->getProcedureLoader()->addLoader($procedureLoader);

            $request = $client->getMessageFactory()->CreateCaptureRequest(self::LINKS[$this->mode]);

        } else {
            $request = $client->getMessageFactory()->CreateRequest(self::LINKS[$this->mode]);
        }

        $request->setTimeout(5000);

        $response = $client->getMessageFactory()->createResponse();

        if($this->mode == 'capture') {
            $request->setOutputFile($this->pathForCapture);
        }

        $client->send($request, $response);

        $this->response = $response;
    }

    private function cleanResponse($response)
    {
        $html = new \Htmldom($response);

        return $html->find('#_farmersvatcompensationportlet_WAR_eskisliferayportlet_fm', 0)->outertext;
    }
}
