<?php

namespace App\Http\Controllers\Documents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DocsPivot;
use App\Animal;
use PDF;
use NumberToWords\NumberToWords;
use App\docPP;
use View;

class SpAgreementController extends Controller
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

        $pdf = PDF::loadView('documents.spagreement', $data)->setPaper('a4')->setOrientation('portrait')->setOptions([
            'margin-bottom' => 0,
            'margin-top'    => 10,
            'margin-left'   => 10,
            'margin-right'  => 10
        ]);

        return $pdf->stream();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getView($id)
    {
        $data = $this->prepareData($id);

        return View::make('documents/multipage.spagreement', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documentInfo = DocsPivot::where('pp_id', $id)->with(['doc_PP'])->get()->toArray()[0];

        return view('documents.edit.spagreement', [
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
        $spAgreement = docPP::findOrFail($id);

        $spAgreement->update($request->all());

        $spAgreement->pivot->update($request->all());

        return redirect('documents')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }

    /**
     * @param $id
     * @return array
     */
    private function prepareData($id)
    {
        $documentInfo = DocsPivot::where('pp_id', $id)->with(['doc_PP'])->get()->toArray()[0];

        $sellerRow = "_______________________________________________";
        if($documentInfo['seller_name']) $sellerRow = $documentInfo['seller_name'];

        $driverRow = "_______________________________________________";
        if($documentInfo['user_name']) $driverRow = $documentInfo['user_name'];

        $bullPriceRow = "_____________";
        if(($documentInfo['doc__p_p']['bull_price']) && ($documentInfo['doc__p_p']['bull_price'] != '0.00')) $bullPriceRow = $documentInfo['doc__p_p']['bull_price'];

        $heiferPriceRow = "_____________";
        if(($documentInfo['doc__p_p']['heifer_price']) && ($documentInfo['doc__p_p']['heifer_price'] != '0.00')) $heiferPriceRow = $documentInfo['doc__p_p']['heifer_price'];

        $cowPriceRow = "_____________";
        if(($documentInfo['doc__p_p']['cow_price']) && ($documentInfo['doc__p_p']['cow_price'] != '0.00')) $cowPriceRow = $documentInfo['doc__p_p']['cow_price'];

        $passSeriesNumberRow = '___________';
        if($documentInfo['seller_pass_series_number']) $passSeriesNumberRow = $documentInfo['seller_pass_series_number'];

        $passSeriesDateRow = '_____________';
        if($documentInfo['seller_pass_issued_date']) $passSeriesDateRow = $documentInfo['seller_pass_issued_date'];

        $sellerBankRow = '_________________________________________';
        if($documentInfo['seller_bank']) $sellerBankRow = $documentInfo['seller_bank'];

        $sellerBankAccountRow = '_____________________________________________';
        if($documentInfo['seller_bank_pay_account_number']) $sellerBankAccountRow = $documentInfo['seller_bank_pay_account_number'];

        $buyerUserRow = '_________________________________';
        if($documentInfo['user_name']) $buyerUserRow = $documentInfo['user_name'];

        if($documentInfo['seller_phone']) $documentInfo['seller_phone'] = "+3706".$documentInfo['seller_phone'];

        return array(
            'documentInfo' => $documentInfo,
            'sellerRow' => $sellerRow,
            'driverRow' => $driverRow,
            'bullPriceRow' => $bullPriceRow,
            'heiferPriceRow' => $heiferPriceRow,
            'cowPriceRow' => $cowPriceRow,
            'passSeriesNumberRow' => $passSeriesNumberRow,
            'passSeriesDateRow' => $passSeriesDateRow,
            'bankRow' => $sellerBankRow,
            'bankAccountRow' => $sellerBankAccountRow,
            'buyerRow' => $buyerUserRow
        );
    }
}
