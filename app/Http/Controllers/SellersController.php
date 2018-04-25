<?php

namespace App\Http\Controllers;

use App\Seller;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSellerRequest;
use Carbon\Carbon;

class SellersController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sellers = Seller::select();

        if(!empty($request->get('search'))) {
            $sellers = Seller::where('name', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('code', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('address', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('phone', 'LIKE', '%'. $request->input('search') .'%');
        }

        if(!empty($request->get('date'))) {
            if($request->get('week')) {
                $sellers = Seller::whereBetween('created_at', array(Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')));
            } else {
                $sellers = Seller::where('created_at', 'LIKE', $request->input('date') . '%');
            }
        }

        $sellers = $sellers->orderBy('created_at', 'desc');
        $sellers = $sellers->paginate(10);
        $sellers->appends($request->all());

        return view('sellers.sellers', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sellers.sellerCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSellerRequest $request)
    {
        $seller = Seller::create($request->toArray());

        $messages[] = $seller->getPostCodeAndUpdate();
        $messages[] = $seller->getVatRateAndUpdate();
        if ($seller->pvm_rate == 6) {
            $messages[] = $seller->getCustomVatCode();
        }

        $messages[] = ['success' => 'Įrašas sėkmingai pridėtas'];

        return $this->responseRedirect('sellers', 'flash_message_multiple', $messages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        return view('sellers.sellerEdit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSellerRequest $request, Seller $seller)
    {
        $messages = array();

        $dateTime = Carbon::createFromTime($request->travel_start_hour, $request->travel_start_minute)->toTimeString();
           // dd($request->toArray());

        if($request->get('address') != $seller->address) {
            $messages[] = $seller->getPostCodeAndUpdate();
        }

        $this->updateAnimalPot($request, $seller);
        $seller->update(['travel_start_time' => $dateTime]);
        $seller->update($request->toArray());

        $messages[] = $seller->getVatRateAndUpdate();

        if ($seller->pvm_rate == 6) {
            $messages[] = $seller->getCustomVatCode();
        }

        $messages[] = ['success' => trans('adminlte_lang::message.updated')];

        return $this->responseRedirect('sellers', 'flash_message_multiple', $messages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();
        $seller->animals()->delete();

        return $this->responseRedirect('sellers', 'flash_message_success',  trans('adminlte_lang::message.deleted'));
    }

    public function updateAnimalPot($request, $seller) {
        foreach ($seller->animals()->get() as $animal) {
            $animal->pot = $request->input('pot-' . $animal->id);
            $animal->save();
        }
    }
}
