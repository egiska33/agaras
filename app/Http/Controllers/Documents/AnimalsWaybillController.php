<?php

namespace App\Http\Controllers\Documents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DocsPivot;
use App\Animal;
use App\docVG;
use PDF;
use View;
use Carbon\Carbon;
use NumberToWords\NumberToWords;

class AnimalsWaybillController extends Controller
{
    /**
     * @return mixed
     */
    public function test()
    {
        return View('documents.animalsWaybill');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $data = $this->prepareData($id);

        $pdf = PDF::loadView('documents.animalsWaybill', $data)->setPaper('a4')->setOrientation('portrait')->setOption('header-left', '[page]/[toPage]');

        return $pdf->stream();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getView($id)
    {
        $data = $this->prepareData($id);

        return View::make('documents/multipage.animalsWaybill', $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $documentInfo = DocsPivot::where('vg_id', $id)->with(['doc_VG'])->get()->toArray()[0];

        if(empty($documentInfo['travel_start_datetime']))
        {
            $now = Carbon::now();

            $documentInfo['travel_start_date'] = $now->toDateString();
            $documentInfo['travel_start_hour'] = $now->format('H');
            $documentInfo['travel_start_minute'] = $now->format('i');
        }
        else
        {
            $travelStartDate = new Carbon($documentInfo['travel_start_datetime']);

            $documentInfo['travel_start_date'] = $travelStartDate->toDateString();
            $documentInfo['travel_start_hour'] = $travelStartDate->format('H');
            $documentInfo['travel_start_minute'] = $travelStartDate->format('i');
        }

        if(empty($documentInfo['travel_arrive_datetime']))
        {
            $nowPlusTravelDuration = Carbon::now()->addHours($documentInfo['doc__v_g']['travel_duration']);

            $documentInfo['travel_arrive_date'] = $nowPlusTravelDuration->toDateString();
            $documentInfo['travel_arrive_hour'] = $nowPlusTravelDuration->format('H');
            $documentInfo['travel_arrive_minute'] = $nowPlusTravelDuration->format('i');
        }
        else
        {
            $travelArriveDate = new Carbon($documentInfo['travel_arrive_datetime']);

            $documentInfo['travel_arrive_date'] = $travelArriveDate->toDateString();
            $documentInfo['travel_arrive_hour'] = $travelArriveDate->format('H');
            $documentInfo['travel_arrive_minute'] = $travelArriveDate->format('i');
        }

        return view('documents.edit.animalsWaybill', [
            'documentId' => $id,
            'documentInfo' => $documentInfo
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $waybill = docVG::findOrFail($id);

        $postInputs = $request->all();

        $travelStartDatetime = $postInputs['travel_start_date']." ".$postInputs['travel_start_hour'].":".$postInputs['travel_start_minute'];
        $travelArriveDateTime = $postInputs['travel_arrive_date']." ".$postInputs['travel_arrive_hour'].":".$postInputs['travel_arrive_minute'];

        $postInputs['travel_start_datetime'] = $travelStartDatetime;
        $postInputs['travel_arrive_datetime'] = $travelArriveDateTime;

        $waybill->update($postInputs);

        $waybill->pivot->update($postInputs);

        return redirect('documents')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }

    /**
     * @param $id
     * @return array
     */
    private function prepareData($id)
    {
        $documentInfo = DocsPivot::where('vg_id', $id)->with(['doc_VG'])->get()->toArray()[0];

        $animals = Animal::where('docs_id', $documentInfo['id'])->get()->map(function($animal, $key) {
            $sexMapper = [
                'Bulius iki 24mėn.' => 'A',
                'Bulius virš 24mėn' => 'B',
                'Kastratas' => 'C',
                'Karvė' => 'D',
                'Telyčia' => 'E',
                'Telyčaitė' => 'E'
            ];

            $animal->specialLetter = $sexMapper[$animal->sex];

            return $animal;
        })->toArray();

        $animalsHolder = [];
        if($documentInfo['seller_name']) array_push($animalsHolder, $documentInfo['seller_name']);
        if($documentInfo['seller_code']) array_push($animalsHolder, $documentInfo['seller_code']);
        if($documentInfo['doc__v_g']['vet_pass_number']) array_push($animalsHolder, $documentInfo['doc__v_g']['vet_pass_number']);
        $animalsHolder = implode(', ', $animalsHolder);

        $animalsHeldPlace = [];
        if($documentInfo['doc__v_g']['held_place_number']) array_push($animalsHeldPlace, $documentInfo['doc__v_g']['held_place_number']);
        if($documentInfo['doc__v_g']['herd_number']) array_push($animalsHeldPlace, $documentInfo['doc__v_g']['herd_number']);
        $animalsHeldPlace = implode(', ', $animalsHeldPlace);

        $sellerAddress = [];
        if($documentInfo['seller_address']) array_push($sellerAddress, $documentInfo['seller_address']);
        if($documentInfo['seller_post_code']) array_push($sellerAddress, $documentInfo['seller_post_code']);
        $sellerAddress = implode(', ', $sellerAddress);

        return array(
            'sellerAddress' => $sellerAddress,
            'documentInfo' => $documentInfo,
            'animals' => $animals,
            'animalsHolder' => $animalsHolder,
            'animalsHeldPlace' => $animalsHeldPlace
        );
    }
}
