<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseController;
use Validator;
use Auth;
use App\Animal;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAnimalRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

class AnimalsController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $animals = Animal::select();

        if(!empty($request->get('search'))) {
            $animals = Animal::where('animal_id', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('passport_id', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('cob', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('inclination', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('real_weight', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('includable_weight', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('pog', 'LIKE', '%'. $request->input('search') .'%');
        }

        if(!empty($request->get('date'))) {
            if($request->get('week')) {
                $animals = Animal::whereBetween('created_at', array(Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')));
            } else {
                $animals = Animal::where('created_at', 'LIKE', $request->input('date') . '%');
            }
        }

        $animals = $animals->orderBy('created_at', 'desc');
        $animals = $animals->paginate(10);
        $animals->appends($request->all());

        return $this->responseView('animals.animals', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('animals.createAnimal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createById(Request $request)
    {
        if (!$request->has('animal_id')) {
            return view('animals.createAnimalById');
        }

        $animalId = Animal::checkAnimalId($request->input('animal_id'));

        $herdNumber = $this->checkIfAnimalIsHealthyAndGetHerdNumber($animalId);

        if ($herdNumber == false) {
            return $this->responseRedirect('animals', 'flash_message_error', trans('adminlte_lang::message.animalNotHealthy'));
        }

        $animalData = $this->getAnimalData($animalId);
        $animalData['herd_number'] = $herdNumber;

        if (!empty($animalData)) {
            return $this->responseView('animals.createAnimalWithID', compact('animalData'));
        }

        return $this->responseRedirect('animals/create', 'flash_message_error', 'Gyvulys nerastas!');
    }


    /**
     * @param CreateAnimalRequest $request
     * @return mixed
     */
    public function store(CreateAnimalRequest $request)
    {
        $data = $request->toArray();

        $data['created_by'] = Auth::user()->id;

        $seller = false;

        $messages = array();

        if(Seller::sellerExists($data['code'])) {
            $seller = Seller::findOrFail(Seller::getSellerId($data['code']));
            $data['seller_id'] = $seller->id;
        } else {
            $sellerData = [
                'name'              => $data['seller_name'],
                'code'              => $data['code'],
                'address'           => $data['seller_address'],
                'pick_up_address'   => $data['seller_address'],
            ];

            $seller = Seller::create($sellerData);

            if (empty($data['post_code'])) {
                $messages[] = $seller->getPostCodeAndUpdate();
            } else {
                $seller->post_code = $data['code'];
            }

            $data['seller_id'] = $seller->id;
        }

        $messages[] = $seller->getVatRateAndUpdate();

        if ($seller->pvm_rate == 6) {
            $messages[] = $seller->getCustomVatCode();
        }

        $animal = Animal::create($data);
        $messages[] = ['success' => trans('adminlte_lang::message.animalCreated')];

        return $this->responseRedirect('animals', 'flash_message_multiple', $messages, [
            'animal' => $animal->toArray(),
            'seller' => $animal->seller->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        $breed = null;
        if(substr($animal->animal_id, 0, 2) == 'LT' && $animal->breed == 'Kiti'){
            $animalId = Animal::checkAnimalId($animal->animal_id);
            $data = $this->getAnimalData($animalId);
            $breed = $data['breed'];
        }
        if($breed == null){
            $breed = $animal->breed;
        }
        return view('animals.animalEdit', compact('animal', 'breed'));
    }


    /**
     * @param CreateAnimalRequest $request
     * @param Animal $animal
     * @return mixed
     */
    public function update(CreateAnimalRequest $request, Animal $animal)
    {

        $animal->update($request->all());
        return redirect('animals')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect('animals')->with('flash_message_success', trans('adminlte_lang::message.deleted'));
    }

    /**
     * Check whether animal is healthy or not
     * @param  string $code
     * @return boolean
     */
    public function checkIfAnimalIsHealthyAndGetHerdNumber($code)
    {
        $code = trim($code);

        $client = new Client();

        $request = $client->get('https://ismain.vic.lt/PublicGPSAS/Gyvunas/GyvunasAsync?nr=' . $code);

        $response = $request->getBody();

        $data = json_decode($response, true);

        if(array_key_exists('error', $data)) {
            return 'empty';
        }

        $herdNumber = $data['Banda'];

        if(!empty($data['SvIki'])) {
            $date = gmdate("Y-m-d", substr($data['SvIki'], 6, 10));

            if(Carbon::now()->lte(Carbon::parse($date))) {
                return false;
            }

            return $herdNumber;
        }

        return $herdNumber;
    }

    /**
     * API request for getting all the information about animal
     * @param  string $code
     * @return mixed
     */
    public function getAnimalData($code)
    {
        $code = Animal::checkAnimalId($code);

        $client = new Client();

        $req = $client->get('http://www.vic.lt:8101/pls/gris/gz5.animal_data?v_galvKodas='. trim($code), [
            'auth' => [env('VIC_USERNAME'), env('VIC_PASSWORD')],
        ]);

        $res = $req->getBody();

        $res = explode('#', mb_convert_encoding($res, 'UTF-8', 'ISO-8859-13'));

        if($res[0] != 'OK1') {
            return false;
        }
        return array(
            'animal_id'         => $code,
            'sex'               => $res[1],
            'breed'             => $res[2],
            'dob'               => str_replace('.', '-', $res[3]),
            'code'              => $res[4],
            'seller_name'       => trim($this->sanitizeString($res[6]) . ' ' . $this->sanitizeString($res[7])),
            'seller_address'    => trim($res[8] . ', ' . $res[9] . ', ' . $res[10]),
            'passport_id'       => $res[11] . $res[12],
        );
    }

    /**
     * Sanitize the string
     * Since API returns strings in WINDOWS-1252 encoding,
     * @param  string $string
     * @return string
     */
    public function sanitizeString($string)
    {
        $string = trim($string);
        $replacements = array(
            'Ą'     => 'ą',
            'Ę'     => 'ę',
            'Į'     => 'į',
            'Ž'     => 'ž',
            'Ū'     => 'ū',
            'Ų'     => 'ų',
            'Ė'     => 'ė',
            'Č'     => 'č',
            'Š'     => 'š',
            'žūb'   => 'ŽŪB',
            'ŽŪB'   => 'ŽŪB',
            'ŽŪb'   => 'ŽŪB',
            '\''    => '',
        );
        $string = strtr(strtolower($string), $replacements);
        $string = mb_convert_case($string, MB_CASE_TITLE, 'UTF-8');
        $string = str_replace('Uab', 'UAB', $string);
        return str_replace('Žūb', 'ŽŪB', $string);
    }
}
