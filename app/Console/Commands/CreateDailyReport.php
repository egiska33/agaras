<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Seller;
use App\DocsPivot;
use Illuminate\Support\Facades\Mail;
use App\Mail\DaySummary;

class CreateDailyReport extends Command
{
    protected $signature = 'report:create-daily';

    protected $description = 'Creates a daily report.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();
        $report = "";

        $dailySellers = Seller::with('animals')
        	->whereHas('animals', function ($q) use ($today) {
        		$q->where('created_at', '>=', $today);
        	})
        	->get();

        foreach ($dailySellers as $seller) {
            $report .= "pardavejas;";
            $report .= $seller->id.";";
            $report .= $seller->name.";";
            $report .= $seller->code.";";
            $report .= $seller->address.";";
            $report .= $seller->post_code.";";
            $report .= $seller->email.";";
            $report .= $seller->fax.";";
            $report .= $seller->farmer_pass_number.";";
            $report .= $seller->bank.";";
            $report .= $seller->bank_pay_account_number.";";
            $report .= $seller->pass_number.";";
            $report .= $seller->pass_issued_date.";";
            if ($seller->has_exemption) {
                $report .= "Taikoma speciali PVM apmokestinamojo momento nustatymo tvarka;";
            } else {
                $report .= ";";
            }
            $report .= "+370".$seller->phone.";";
            $report .= $seller->seller_representative.";";
            $report .= $seller->pvm_code.";";
            $report .= $seller->pvm_rate.";";
            $report .= $seller->pick_up_address.";";
            $report .= implode(', ', $seller->fooder).";";
            $report .= $seller->prosperity_evaluation.";";
            $report .= $seller->possesion.";";

            foreach ($seller->animals->where('created_at', '>=', $today) as $animal) {
                $report .= "\r\n";

                $report .= "gyvulys;";
                $report .= $animal->id.";";
                $report .= $animal->animal_id.";";
                $report .= $animal->passport_id.";";
                $report .= $animal->herd_number.";";
                $report .= $animal->sex.";";
                $report .= $animal->breed.";";
                $report .= $animal->dob.";";
                $report .= $animal->cob.";";
                $report .= $animal->pog.";";
                $report .= $animal->inclination.";";
                $report .= $animal->real_weight.";";
                $report .= $animal->includable_weight.";";
                $report .= $animal->price_kg.";";
                $report .= $animal->pot.";";
            }

            $report .= "\r\n";
            $report .= "\r\n";
            $report .= "\r\n";
        }

        // Storage::put('reports/'.$today->toDateString().".txt", $report, "private");
        // Mail::to('a.berneckas@gmail.com')->send(new DaySummary());
        // Mail::to('kzlsks@gmail.com')->send(new DaySummary());
    }
}
