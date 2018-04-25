<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DocsPivot;
use App\Animal;
use PDF;
use NumberToWords\NumberToWords;
use App\docSF;
use View;
use Carbon\Carbon;

class VatInvoiceController extends Controller
{
    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $data = $this->prepareData($id);

        $pdf = PDF::loadView('documents.vatInvoice', $data)->setPaper('a4')->setOrientation('portrait')->setOption('header-left', '[page]/[toPage]');

        return $pdf->stream();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getView($id)
    {
        $data = $this->prepareData($id);

        return View::make('documents/multipage.vatInvoice', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $vatInvoice = docSF::findOrFail($id);

        $vatInvoice->update($request->all());

        $vatInvoice->pivot->update($request->all());

        return redirect('documents')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }

    /**
     * @param Request $request
     * @param $documentId
     * @return mixed
     */
    public function edit(Request $request, $documentId)
    {
        $documentInfo = DocsPivot::where('sf_id', $documentId)->with(['doc_SF'])->get()->toArray()[0];

        return view('documents.edit.vatInvoice', [
	    	'documentId' => $documentId,
            'documentInfo' => $documentInfo
		]);
    }

    /**
     * @param $id
     * @return array
     */
    private function prepareData($id)
    {
        $documentInfo = DocsPivot::where('sf_id', $id)->with(['doc_SF'])->get()->toArray()[0];

        $animals = Animal::where('docs_id', $documentInfo['id'])->where("inclination", ">", 0)->get()->map(function($animal, $key) {
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
        if($documentInfo['seller_name']) array_push($animalsSeller, $documentInfo['seller_name']);
        if($documentInfo['seller_address']) array_push($animalsSeller, $documentInfo['seller_address']);
        if($documentInfo['seller_post_code']) array_push($animalsSeller, $documentInfo['seller_post_code']);
        if($documentInfo['seller_phone'])
        {
            array_push($animalsSeller, "+3706".$documentInfo['seller_phone']);
            $documentInfo['seller_phone'] = "+3706".$documentInfo['seller_phone'];
        }
        if($documentInfo['seller_fax']) array_push($animalsSeller, $documentInfo['seller_fax']);
        if($documentInfo['seller_email']) array_push($animalsSeller, $documentInfo['seller_email']);
        $animalsSeller = implode(', ', $animalsSeller);

        $companyCodeRow = '______________________________________';
        if($documentInfo['seller_code']) $companyCodeRow = $documentInfo['seller_code'];

        $pvmPayerCode = '______________________________________';
        if($documentInfo['seller_pvm_code']) $pvmPayerCode = $documentInfo['seller_pvm_code'];

        $passSerieAndNumberRow = '_______________________________________';
        if($documentInfo['seller_pass_series_number']) $passSerieAndNumberRow = $documentInfo['seller_pass_series_number'];

        $passDateRow = '_________________________________________________';
        if($documentInfo['seller_pass_issued_date']) $passDateRow = $documentInfo['seller_pass_issued_date'];

        $bankRow = '_____________________________';
        if($documentInfo['seller_bank']) $bankRow = $documentInfo['seller_bank'];

        $bankAccountRow = '________________________________________';
        if($documentInfo['seller_bank_pay_account_number']) $bankAccountRow = $documentInfo['seller_bank_pay_account_number'];

        $farmerPassRow = '_______________';
        if($documentInfo['doc__s_f']['farmer_pass_number']) $farmerPassRow = $documentInfo['doc__s_f']['farmer_pass_number'];

        $driverRow = '___________________________________';
        if($documentInfo['user_name']) $driverRow = $documentInfo['user_name'];

        $carPlatesRow = '_________________';
        if($documentInfo['user_plate']) $carPlatesRow = $documentInfo['user_plate'];

        $loadAddressRow = '__________________________________________________________________';
        if($documentInfo['seller_pick_up_address']) $loadAddressRow = $documentInfo['seller_pick_up_address'];

        $loadDateRow = '______________________';
        if($documentInfo['travel_start_datetime']) $loadDateRow = substr($documentInfo['travel_start_datetime'], 0, 10);
        if(substr($loadDateRow, 0, 9) == 'undefined') $loadDateRow = Carbon::now()->toDateString();

        $totalPrice = 0;
        $priceVat21 = "";
        $priceVat6 = "";

        if($documentInfo['seller_pvm_rate'] == "21")
        {
            $priceVat21 = $totalAnimalsPrice * 1.21;
            $totalPrice = $priceVat21;
            $priceVat21 = $priceVat21 - $totalAnimalsPrice;
            $priceVat21 = number_format($priceVat21, 2, '.', '');
        }
        else if ($documentInfo['seller_pvm_rate'] == "6")
        {
            $priceVat6 = $totalAnimalsPrice * 1.06;
            $totalPrice = $priceVat6;
            $priceVat6 = $priceVat6 - $totalAnimalsPrice;
            $priceVat6 = number_format($priceVat6, 2, '.', '');
        }
        else $totalPrice = $totalAnimalsPrice;

        $totalAnimalsPrice = number_format($totalAnimalsPrice, 2, '.', '');
        $totalPrice = number_format($totalPrice, 2, '.', '');
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('lt');
        $euroInWords = ucfirst($numberTransformer->toWords(explode('.', $totalPrice)[0])." EUR,");
        $centsInWords = '00 ct.';

        if (explode('.', $totalPrice)[1] > 0) {
            $centsInWords = explode('.', $totalPrice)[1] . " ct.";
        }

        return array(
            'documentInfo' => $documentInfo,
            'animals' => $animals,
            'totalAnimalsPrice' => $totalAnimalsPrice,
            'animalsSeller' => $animalsSeller,
            'totalPrice' => $totalPrice,
            'euroInWords' => $euroInWords,
            'centsInWords' => $centsInWords,
            'priceVat21' => $priceVat21,
            'priceVat6' => $priceVat6,
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
            'loadDateRow' => $loadDateRow
        );
    }
}
