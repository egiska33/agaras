<?php

namespace App\Http\Controllers\Documents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DocsPivot;
use App\Animal;
use Carbon\Carbon;
use PDF;
use View;
use NumberToWords\NumberToWords;
use App\docKV;

class WaybillController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->prepareData($id);

        $pdf = PDF::loadView('documents.waybill', $data)->setPaper('a4')->setOrientation('portrait');

        return $pdf->stream();
    }

    public function getView($id)
    {
        $data = $this->prepareData($id);

        return View::make('documents/multipage.waybill', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documentInfo = DocsPivot::where('kv_id', $id)->with(['doc_KV'])->get()->toArray()[0];

        if(empty($documentInfo['travel_start_datetime']))
        {
            $now = Carbon::now();

            $documentInfo['travel_start_date'] = $now->toDateString();
            $documentInfo['travel_start_hour'] = $now->format('H');
            $documentInfo['travel_start_minute'] = $now->format('i');
        }
        else
        {
            // $travelStartDate = Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'], 'Europe/Vilnius');
            $travelStartDate = new Carbon($documentInfo['travel_start_datetime']);

            $documentInfo['travel_start_date'] = $travelStartDate->toDateString();
            $documentInfo['travel_start_hour'] = $travelStartDate->format('H');
            $documentInfo['travel_start_minute'] = $travelStartDate->format('i');
        }

        if(empty($documentInfo['travel_arrive_datetime']))
        {
            $now = Carbon::now();

            $documentInfo['travel_arrive_date'] = $now->toDateString();
            $documentInfo['travel_arrive_hour'] = $now->format('H');
            $documentInfo['travel_arrive_minute'] = $now->format('i');
        }
        else
        {
            // $travelArriveDate = Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_arrive_datetime'], 'Europe/Vilnius');
            $travelArriveDate = new Carbon($documentInfo['travel_arrive_datetime']);

            $documentInfo['travel_arrive_date'] = $travelArriveDate->toDateString();
            $documentInfo['travel_arrive_hour'] = $travelArriveDate->format('H');
            $documentInfo['travel_arrive_minute'] = $travelArriveDate->format('i');
        }

        return view('documents.edit.waybill', [
            'documentId' => $id,
            'documentInfo' => $documentInfo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $wayBill = docKV::findOrFail($id);

        $wayBill->update($request->all());

        $wayBill->pivot->update($request->all());

        return redirect('documents')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }

    /**
     * @param $id
     * @return array
     */
    private function prepareData($id)
    {
        $documentInfo = DocsPivot::where('kv_id', $id)->with(['doc_KV'])->get()->toArray()[0];

        $animals = Animal::where('docs_id', $documentInfo['id'])->where("inclination", 0)->get()->map(function($animal, $key) {
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

        $animalsSeller = [];
        if($documentInfo['seller_name']) array_push($animalsSeller, $documentInfo['seller_name']);
        if($documentInfo['seller_address']) array_push($animalsSeller, $documentInfo['seller_address']);
        if($documentInfo['seller_post_code']) array_push($animalsSeller, $documentInfo['seller_post_code']);
        if($documentInfo['seller_phone']) array_push($animalsSeller, "+3706".$documentInfo['seller_phone']);
        if($documentInfo['seller_fax']) array_push($animalsSeller, $documentInfo['seller_fax']);
        if($documentInfo['seller_email']) array_push($animalsSeller, $documentInfo['seller_email']);
        $animalsSeller = implode(', ', $animalsSeller);

        $now = Carbon::now();

        $loadDateTime = $now->year."m. ".sprintf("%02d", $now->month)."mėn. ".sprintf("%02d", $now->day)."d. ".sprintf("%02d", $now->hour)."val. ".sprintf("%02d", $now->minute)."min.";
        if($documentInfo['travel_start_datetime'])
        {
            $loadDateTimeObject = new Carbon($documentInfo['travel_start_datetime']);
            $loadDateTime = $loadDateTimeObject->format('Y')."m. ".$loadDateTimeObject->format('m')."mėn. ".$loadDateTimeObject->format('d')."d. ".$loadDateTimeObject->format('H')."val. ".$loadDateTimeObject->format('i')."min.";
        }

        if(empty($documentInfo['travel_arrive_datetime']))
        {
            $documentInfo['travel_arrive_datetime'] = '';
            $documentInfo['travel_arrive_datetime'] = $now->year."-".sprintf("%02d", $now->month)."-".sprintf("%02d", $now->day)." ".sprintf("%02d", $now->hour).":".sprintf("%02d", $now->minute);
        }

        if(empty($documentInfo['travel_start_datetime']))
        {
            $documentInfo['travel_start_datetime'] = $now->year."-".sprintf("%02d", $now->month)."-".sprintf("%02d", $now->day)." ".sprintf("%02d", $now->hour).":".sprintf("%02d", $now->minute);
        }


        $userRow = "Vairuotojas ";
        if($documentInfo['user_name']) $userRow .= $documentInfo['user_name'];
        else $userRow .= "______________________________________________________";

        $userRow .= " Automobilio Nr. ";
        if($documentInfo['user_plate']) $userRow .= $documentInfo['user_plate'];
        else $userRow .= "______________________________";

        $vetPassNumber = "___________________________________________";
        if($documentInfo['doc__k_v']['user_travel_paper_number']) $vetPassNumber = $documentInfo['doc__k_v']['user_travel_paper_number'];


        $ppDoc = DocsPivot::where('kv_id', $id)->with(['doc_PP'])->get()[0];


        return array(
            'ppSeries' => $ppDoc->doc_PP->serial,
            'ppNo' => $ppDoc->doc_PP->no,
            'documentInfo' => $documentInfo,
            'animals' => $animals,
            'animalsSeller' => $animalsSeller,
            'loadDateTime' => $loadDateTime,
            'userRow' => $userRow,
            'vetPassNumber' => $vetPassNumber
        );
    }
}
