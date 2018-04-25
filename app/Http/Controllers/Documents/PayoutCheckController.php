<?php

namespace App\Http\Controllers\Documents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DocsPivot;
use App\Animal;
use PDF;
use NumberToWords\NumberToWords;
use App\docPI;
use View;

class PayoutCheckController extends Controller
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

        $pdf = PDF::loadView('documents.payoutCheck', $data)
            ->setPaper('a4')
            ->setOrientation('portrait')
            ->setOptions([
                'margin-bottom' => 20,
                'margin-top'    => 20,
                'margin-left'   => 30,
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

        return View::make('documents/multipage.payoutCheck', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documentInfo = DocsPivot::where('pi_id', $id)->with(['doc_PI'])->get()->toArray()[0];

        if(isset(explode('.', $documentInfo['doc__p_i']['paid_sum'])[1])) $paidCents = explode('.', $documentInfo['doc__p_i']['paid_sum'])[1];
        else $paidCents = '0';

        return view('documents.edit.payoutCheck', [
            'documentId' => $id,
            'documentInfo' => $documentInfo,
            'paidCents' => $paidCents
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
        $payoutCheck = docPI::findOrFail($id);

        $postInputs = $request->all();

        $paidSum = (float)$postInputs['paid_sum_eur'] + (float)$postInputs['paid_sum_ct'] * 0.01;
        $postInputs['paid_sum'] = $paidSum;

        $payoutCheck->update($postInputs);
        $payoutCheck->pivot->update($postInputs);

        return redirect('documents')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }

    /**
     * @param $id
     * @return array
     */
    private function prepareData($id)
    {
        $documentInfo = DocsPivot::where('pi_id', $id)->with(['doc_PI'])->get()->toArray()[0];

        $moneyReceiver = [];
        if($documentInfo['seller_name']) array_push($moneyReceiver, $documentInfo['seller_representative']);
        $moneyReceiver = implode(', ', $moneyReceiver);

        $totalPrice = number_format($documentInfo['doc__p_i']['paid_sum'], 2, '.', '');
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('lt');
        $euroInWords = ucfirst($numberTransformer->toWords(explode('.', $totalPrice)[0])." EUR,");
        $centsInWords = $totalPrice[1] ." ct.";

        if(isset(explode('.', $documentInfo['doc__p_i']['paid_sum'])[1])) $paidCents = explode('.', $documentInfo['doc__p_i']['paid_sum'])[1];
        else $paidCents = '0';

        $sfDoc = DocsPivot::where('pi_id', $id)->first();
        $paidForField = "";
        if (!empty($sfDoc->doc_SF)) {
            $paidForField = "pagal SF: Serija ".$sfDoc->doc_SF->serial." Nr.".$sfDoc->doc_SF->no;
        }

        return array(
            'documentInfo' => $documentInfo,
            'euroInWords' => $euroInWords,
            'centsInWords' => $centsInWords,
            'moneyReceiver' => $moneyReceiver,
            'paidCents' => $paidCents,
            'paidForField' => $paidForField 
        );
    }
}
