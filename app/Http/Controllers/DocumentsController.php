<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Controllers\Documents\AnimalsWaybillController;
use App\Http\Controllers\Documents\InvoiceController;
use App\Http\Controllers\Documents\PayoutCheckController;
use App\Http\Controllers\Documents\SpAgreementController;
use App\Http\Controllers\Documents\VatInvoiceController;
use App\Http\Controllers\Documents\WaybillController;
use App\Http\Controllers\ResponseController;
use App\DocumentsConfiguration;
use App\DocumentsSerials;
use App\Animal;
use App\User;
use App\Driver;
use App\Seller;
use App\DocsPivot;
use App\docKV;
use App\docPI;
use App\docPP;
use App\docSF;
use App\docVG;
use PDF;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocumentsController extends ResponseController
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $allDocuments = DocsPivot::select();
         if(!empty($request->get('date'))) {

            $allDocuments = $allDocuments->where('created_at', 'LIKE', $request->input('date') . '%');
        }
     
        if(!empty($request->get('driver'))) {
            $allDocuments = $allDocuments->where('user_name', '=', $request->input('driver'));
        }

        $allDocuments = $allDocuments->orderBy('created_at', 'desc');
        $allDocuments = $allDocuments->paginate(10);
        $allDocuments->appends($request->all());

        $todayNewAnimals = Animal::
            whereDate('created_at', "=", Carbon::today())
            ->with('seller')
            ->groupBy('seller_id')
            ->get()
            ->toArray();

        $now = Carbon::now();

        return view('documents.documents', [
            'newAnimals' => $todayNewAnimals,
            'allDocuments' => $allDocuments,
            'now' => $now,
            'drivers' => User::role('driver')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $driver = Driver::findOrFail(Auth::user()->id);

        $docVGId = NULL;
        $docSFId = NULL;
        $docPIId = NULL;
        $docPPId = NULL;
        $docKVId = NULL;

        $response = array();

        if ($request->has('kv')) {
            $docKV = docKV::create($request->input('kv'));
            $response['kv'] = $docKV->toArray();
            $docKVId = $docKV->id;
        }

        if ($request->has('pp')) {
            $docPP = docPP::create($request->input('pp'));
            $response['pp'] = $docPP->toArray();
            $docPPId = $docPP->id;
        }

        if ($request->has('vg')) {
            $docVG = docVG::create($request->input('vg'));
            $response['vg'] = $docVG->toArray();
            $docVGId = $docVG->id;
        }

        if ($request->has('sf')) {
            $docSF = docSF::create($request->input('sf'));
            $response['sf'] = $docSF->toArray();
            $docSFId = $docSF->id;
        }

        if ($request->has('pi')) {
            $docPI = docPI::create($request->input('pi'));
            $response['pi'] = $docPI->toArray();
            $docPIId = $docPI->id;
        }

        if ($request->has('pivot')) {
            $pivot = $request->input('pivot');
            $pivot['vg_id'] = $docVGId;
            $pivot['sf_id'] = $docSFId;
            $pivot['pi_id'] = $docPIId;
            $pivot['pp_id'] = $docPPId;
            $pivot['kv_id'] = $docKVId;
            $docsPivot = DocsPivot::create($pivot);
            $response['pivot'] = $docsPivot->toArray();
        }

        if ($request->has('animals')) {
            Animal::whereIn('id', $request->input('animals'))->update(['docs_id' => $docsPivot->id]);
        }

        if ($request->has('serials')) {
            $driver->serials->update($request->input('serials'));
            $response['serials'] = $driver->serials->toArray();
        }

        return $this->responseJson($response);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $response = array();

        if(!$request->has('pivot')) {
            return $this->responseJson(['error' => 'No pivot provided!']);
        }

        $pivot = $request->input('pivot');
        $docsPivot = DocsPivot::findOrFail($pivot['db_id']);

        $docsPivot->update($request->input('pivot'));
        $response['pivot'] = $docsPivot->toArray();

        if ($request->has('kv')) {
            $docsPivot->doc_KV->update($request->input('kv'));
            $response['kv'] = $docsPivot->doc_KV->toArray();
        }

        if ($request->has('pp')) {
            $docsPivot->doc_PP->update($request->input('pp'));
            $response['pp'] = $docsPivot->doc_PP->toArray();
        }

        if ($request->has('vg')) {
            $docsPivot->doc_VG->update($request->input('vg'));
            $response['vg'] = $docsPivot->doc_VG->toArray();
        }

        if ($request->has('sf')) {
            $docsPivot->doc_SF->update($request->input('sf'));
            $response['sf'] = $docsPivot->doc_SF->toArray();
        }

        if ($request->has('pi')) {
            $docsPivot->doc_PI->update($request->input('pi'));
            $response['pi'] = $docsPivot->doc_PI->toArray();
        }

        return $this->responseJson($response);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        if(empty($request->input('sellerId'))) {
            return back()->with('flash_message_error', 'Nepasirinkote pardavėjo');
        }

        $targetSellerId = $request->input('sellerId');

        $driver = User::findOrFail(Auth::user()->id);
        $seller = Seller::findOrFail($targetSellerId);

        $pivot = new DocsPivot;

        $this->handleDocsPivot($pivot, $driver, $seller);

        $hasInclination = false;
        $isSlaughtered = false;

        foreach ($seller->animals as $animal) {
            if($animal->inclination > 0) {
                $hasInclination = true;
            }

            if($animal->inclination == 0) {
                $isSlaughtered = true;
            }
        }

        if($isSlaughtered) {
            // Generates when one or more animals has its inclination set to 0
            $docKV = new docKV;
            $docKV->serial = DocumentsConfiguration::get('cargo_note_serial');
            $docKV->no = DocumentsConfiguration::getDocumentNumberAndUpdateOld('cargo_note_no');
            $docKV->save();
            $pivot->kv_id = $docKV->id;

            // Only generate if row contains animals with inclination set to 0
            $docPP = new docPP;
            $docPP->serial = DocumentsConfiguration::get('spa_serial');
            $docPP->no = DocumentsConfiguration::getDocumentNumberAndUpdateOld('spa_no');
            $docPP->save();
            $pivot->pp_id = $docPP->id;
        }

        // Invoice should have animals which inclination is set to 1 or more. If no animals are found with inclination 1-3. Do not generate invoice
        // Check if seller have VAT or not. If yes prepare VAT INVOICE, if not prepare simple invoice
        if($hasInclination) {
            $docSF = new docSF;
            if(empty($seller->pvm_code)) {
                $docSF->serial = DocumentsConfiguration::get('invoice_serial');
                $docSF->no = DocumentsConfiguration::getDocumentNumberAndUpdateOld('invoice_no');
            } else {
                $docSF->serial = DocumentsConfiguration::get('vat_invoice_serial');
                $docSF->no = DocumentsConfiguration::getDocumentNumberAndUpdateOld('vat_invoice_no');
            }
            $docSF->save();
            $pivot->sf_id = $docSF->id;
        }

        // Manually generate. Need to make a button or radio button
        if($request->input('create_pi')) {
            $docPI = new docPI;
            $docPI->serial = DocumentsConfiguration::get('cwr_serial');
            $docPI->no = DocumentsConfiguration::getDocumentNumberAndUpdateOld('cwr_no');
            $docPI->save();
            $pivot->pi_id = $docPI->id;
        }

        // Always create
        $docVG = new docVG;
        $docVG->save();
        $pivot->vg_id = $docVG->id;

        $pivot->save();

        Animal::whereDate('created_at', "=", Carbon::today())
            ->where('seller_id', $targetSellerId)
            ->update(['docs_id' => $pivot->id]);

        return back()->with('flash_message_success', 'Dokumentai suformuoti!');
    }

    /**
     * @param DocsPivot $document
     * @return mixed
     */
    public function destroy(DocsPivot $document)
    {
        $document->doc_KV()->delete();
        $document->doc_PI()->delete();
        $document->doc_PP()->delete();
        $document->doc_SF()->delete();
        $document->doc_VG()->delete();
        $document->delete();

        return back()->with('flash_message_success', 'Dokumentai ištrinti');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function print(Request $request)
    {
        if (!$request->has('row-id') ) {
            return back()->with('flash_message_error', 'Klaida!');
        }

        $pivot = DocsPivot::findOrFail($request->input('row-id'));

        if ($request->has('printAll')) {
            $pages = $this->preparePrintAll($pivot);
        } else if ($request->has('printSelected')) {
            $pages = $this->preparePrintSelected($request, $pivot);
        }

        if (empty($pages)) {
            return back()->with('flash_message_error', 'Klaida!');
        }

        $pdf = PDF::loadView('documents.multipage', ['pages' => $pages])->setOption('header-left', '[page]/[topage]');
//        dd($pdf);
        return $pdf->stream();
    }

    /**
     * @return mixed
     */
    public function getSerials()
    {
        $serials = DocumentsSerials::where('user_id', Auth::user()->id)->get();

        return response()->json([
            'serials' => $serials
        ]);
    }

    /**
     * @param DocsPivot $pivot
     * @param User $driver
     * @param Seller $seller
     */
    private function handleDocsPivot(DocsPivot $pivot, User $driver, Seller $seller)
    {
        $pivot->user_name = $driver->name;
        $pivot->user_phone = $driver->phone;
        $pivot->user_plate = $driver->plate;
        $pivot->user_position = $driver->position;
        $pivot->user_trailer_plates = $driver->trailer_plates;

        $pivot->seller_name = $seller->name;
        $pivot->seller_code = $seller->code;
        $pivot->seller_address = $seller->address;
        $pivot->seller_pvm_code = $seller->pvm_code;
        $pivot->seller_phone = $seller->phone;
        $pivot->seller_pvm_rate = $seller->pvm_rate;
        $pivot->seller_pick_up_address = $seller->pick_up_address;

        $pivot->save();
    }

    /**
     * @param DocsPivot $pivot
     * @return array
     */
    private function preparePrintAll(DocsPivot $pivot)
    {
        $pages = array();

        if (!empty($pivot->vg_id)) {
            $awbc = new AnimalsWaybillController;
            $pages[] = $awbc->getView($pivot->vg_id);
        }

        if (!empty($pivot->sf_id)) {
            if (!empty($pivot->seller_pvm_code)) {
                $vatSf = new VatInvoiceController;
                $pages[] = $vatSf->getView($pivot->sf_id);
            } else {
                $sf = new InvoiceController;
                $pages[] = $sf->getView($pivot->sf_id);
            }
        }

        if (!empty($pivot->pi_id)) {
            $payoutCheck = new PayoutCheckController;
            $pages[] = $payoutCheck->getView($pivot->pi_id);
        }

        if (!empty($pivot->pp_id)) {
            $spAgreement = new SpAgreementController;
            $pages[] = $spAgreement->getView($pivot->pp_id);
        }

        if (!empty($pivot->kv_id)) {
            $waybill = new WaybillController;
            $pages[] = $waybill->getView($pivot->kv_id);
        }
        return $pages;
    }

    /**
     * @param Request $request
     * @param DocsPivot $pivot
     * @return array
     */
    private function preparePrintSelected(Request $request, DocsPivot $pivot)
    {
        $pages = array();

        if (!empty($pivot->vg_id) && $request->has('print_vg')) {
            $awbc = new AnimalsWaybillController;
            $pages[] = $awbc->getView($pivot->vg_id);
        }

        if (!empty($pivot->sf_id) && $request->has('print_sf')) {
            if (!empty($pivot->seller_pvm_code)) {

                    $vatSf = new VatInvoiceController;
                    $pages[] = $vatSf->getView($pivot->sf_id);

            } else {
                $sf = new InvoiceController;
                $pages[] = $sf->getView($pivot->sf_id);
            }
        }

        if (!empty($pivot->pi_id) && $request->has('print_pi')) {
            $payoutCheck = new PayoutCheckController;
            $pages[] = $payoutCheck->getView($pivot->pi_id);
        }

        if (!empty($pivot->pp_id) && $request->has('print_pp')) {
            $spAgreement = new SpAgreementController;
            $pages[] = $spAgreement->getView($pivot->pp_id);
        }

        if (!empty($pivot->kv_id) && $request->has('print_kv')) {
            $waybill = new WaybillController;
            $pages[] = $waybill->getView($pivot->kv_id);
        }

        return $pages;
    }
}
