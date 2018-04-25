<?php

namespace App\Http\Controllers\Documents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Animal;
use PDF;
use Auth;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $targetSellers = $request->input('sellerId');
        $postedInputs = $request->all();

        if(!empty($targetSellers))
        {
            $sellerAnimals = Animal::whereIn('seller_id', $targetSellers)->get()->toArray();

            $bullTill24MonthsCount = 0;
            $bullAfter24MonthsCount = 0;
            $cowsCount = 0;
            $heifersCount = 0;
            $totalAnimals = 0;

            foreach ($sellerAnimals as $key => $animal)
            {
                $sellerAnimals[$key]['agent_name'] = $request->input('agent_'.$animal['seller_id']);
                $animalMonths = Carbon::now()->diffInMonths(Carbon::createFromFormat('Y-m-d', $animal['dob']));
                if((Animal::trimUntilFirstLetter($animal['sex']) == 'K') && ($animalMonths <= 24)) $bullTill24MonthsCount++;
                if((Animal::trimUntilFirstLetter($animal['sex']) == 'K') && ($animalMonths > 24)) $bullAfter24MonthsCount++;
                if((Animal::trimUntilFirstLetter($animal['sex']) == 'B') && ($animalMonths <= 24)) $bullTill24MonthsCount++;
                if((Animal::trimUntilFirstLetter($animal['sex']) == 'B') && ($animalMonths > 24)) $bullAfter24MonthsCount++;
                if(Animal::trimUntilFirstLetter($animal['sex']) == 'K') $cowsCount++;
                if(Animal::trimUntilFirstLetter($animal['sex']) == 'T') $heifersCount++;

                $sexMapper = [
                    'Bulius iki 24mėn.' => 'A',
                    'Bulius virš 24mėn' => 'B',
                    'Kastratas' => 'C',
                    'Karvė' => 'D',
                    'Telyčia' => 'E',
                    'Telyčaitė' => 'E'
                ];

                $sellerAnimals[$key]['specialLetter'] = $sexMapper[$animal['sex']];

                $totalAnimals++;
            }

            $pdf = PDF::loadView('documents.application', [
                'sellerAnimals' => $sellerAnimals,
                'youngBullCount' => $bullTill24MonthsCount,
                'oldBullCount' => $bullAfter24MonthsCount,
                'cowCount' => $cowsCount,
                'heiferCount' => $heifersCount,
                'totalAnimals' => $totalAnimals,
                'buyer_name' => $postedInputs['buyer_name'],
                'buyer_animals_from' => $postedInputs['buyer_animals_from'],
                'buyer_animals_deliver_date' => $postedInputs['buyer_animals_deliver_date'],
                'buyer_animals_deliver_hour' => $postedInputs['buyer_animals_deliver_hour'],
                ])->setPaper('a4')->setOrientation('landscape');
            return $pdf->stream();
        }
        else
        {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
