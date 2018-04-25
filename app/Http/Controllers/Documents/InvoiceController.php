<?php

namespace App\Http\Controllers\Documents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DocsPivot;
use App\Animal;
use PDF;
use NumberToWords\NumberToWords;
use App\docSF;
use View;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->prepareData($id);

        $pdf = PDF::loadView('documents.invoice', $data)->setPaper('a4')->setOrientation('portrait')->setOption('header-left', '[page]/[toPage]');

        return $pdf->stream();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getView($id)
    {
        $data = $this->prepareData($id);

        return View::make('documents/multipage.invoice', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = docSF::findOrFail($id);

        $invoice->update($request->all());

        $invoice->pivot->update($request->all());

        return redirect('documents')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }

    /**
     * @param $id
     * @return array
     */
    private function prepareData($id)
    {
        $documentInfo = DocsPivot::where('sf_id', $id)->with(['doc_SF'])->get()->toArray()[0];

        $animals = Animal::where('docs_id', $documentInfo['id'])->where("inclination", ">", 0)->get()->map(function ($animal, $key) {
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

        $totalAnimalsPrice = 0;

        foreach ($animals as $animal) {
            $totalAnimalsPrice += $animal['includable_weight'] * $animal['price_kg'];
        }

        $animalsSeller = [];
        if ($documentInfo['seller_name']) array_push($animalsSeller, $documentInfo['seller_name']);
        if ($documentInfo['seller_address']) array_push($animalsSeller, $documentInfo['seller_address']);
        if ($documentInfo['seller_post_code']) array_push($animalsSeller, $documentInfo['seller_post_code']);
        if ($documentInfo['seller_phone']) {
            array_push($animalsSeller, "+3706" . $documentInfo['seller_phone']);
            $documentInfo['seller_phone'] = "+3706" . $documentInfo['seller_phone'];
        }
        if ($documentInfo['seller_fax']) array_push($animalsSeller, $documentInfo['seller_fax']);
        if ($documentInfo['seller_email']) array_push($animalsSeller, $documentInfo['seller_email']);
        $animalsSeller = implode(', ', $animalsSeller);

        $companyCodeRow = '______________________________________';
        if ($documentInfo['seller_code']) $companyCodeRow = $documentInfo['seller_code'];

        $pvmPayerCode = trans('adminlte_lang::message.noPvm');
        if ($documentInfo['seller_pvm_code']) $pvmPayerCode = $documentInfo['seller_pvm_code'];

        $passSerieAndNumberRow = '_______________________________________';
        if ($documentInfo['seller_pass_series_number']) $passSerieAndNumberRow = $documentInfo['seller_pass_series_number'];

        $passDateRow = '_________________________________________________';
        if ($documentInfo['seller_pass_issued_date']) $passDateRow = $documentInfo['seller_pass_issued_date'];

        $bankRow = '_____________________________';
        if ($documentInfo['seller_bank']) $bankRow = $documentInfo['seller_bank'];

        $bankAccountRow = '________________________________________';
        if ($documentInfo['seller_bank_pay_account_number']) $bankAccountRow = $documentInfo['seller_bank_pay_account_number'];

        $farmerPassRow = '_______________';
        if ($documentInfo['doc__s_f']['farmer_pass_number']) $farmerPassRow = $documentInfo['doc__s_f']['farmer_pass_number'];

        $driverRow = '___________________________________';
        if ($documentInfo['user_name']) $driverRow = $documentInfo['user_name'];

        $carPlatesRow = '_________________';
        if ($documentInfo['user_plate']) $carPlatesRow = $documentInfo['user_plate'];

        $loadAddressRow = '__________________________________________________________________';
        if ($documentInfo['seller_pick_up_address']) $loadAddressRow = $documentInfo['seller_pick_up_address'];

        $loadDateRow = '______________________';
        if (!empty($documentInfo['travel_start_datetime'])) {
            $date = Carbon::parse($documentInfo['travel_start_datetime']);

            $format = 'Y-m-d';

            if ($date->hour != 0) {
                $format = 'Y-m-d h:i';
            }

            $loadDateRow = $date->format($format);
        }

        $totalAnimalsPrice = number_format($totalAnimalsPrice, 2, '.', '');
        $totalPrice = number_format($totalAnimalsPrice, 2, '.', '');

        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('lt');
        $euroInWords = ucfirst($numberTransformer->toWords(explode('.', $totalAnimalsPrice)[0]) . " EUR,");
        $centsInWords = '00 ct.';

        if (explode('.', $totalPrice)[1] > 0) {
            $centsInWords = explode('.', $totalPrice)[1] . " ct.";
        }


        return array(
            'documentInfo' => $documentInfo,
            'animals' => $animals,
            'totalPrice' => $totalPrice,
            'totalAnimalsPrice' => $totalAnimalsPrice,
            'animalsSeller' => $animalsSeller,
            'euroInWords' => $euroInWords,
            'centsInWords' => $centsInWords,
            'companyCodeRow' => $companyCodeRow,
            'pvmPayerCode' => $pvmPayerCode,
            'passSerieAndNumberRow' => $passSerieAndNumberRow,
            'passDateRow' => $passDateRow,
            'bankRow' => $bankRow,
            'bankAccountRow' => $bankAccountRow,
            'farmerPassRow' => $farmerPassRow,
            'driverRow' => $driverRow,
            'carPlatesRow' => $carPlatesRow,
            'loadAddressRow' => $loadAddressRow,
            'loadDateRow' => $loadDateRow,
        );
    }
}
