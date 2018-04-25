<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocsPivot extends Model
{
    protected $table = "docs_pivot";

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'vg_id',
        'sf_id',
        'pi_id',
        'pp_id',
        'kv_id',

        'user_name',
        'user_phone',
        'user_plate',
        'user_position',
        'user_trailer_plates',

        'seller_name',
        'seller_code',
        'seller_address',
        'seller_pvm_code',
        'seller_phone',
        'seller_pvm_rate',
        'seller_pick_up_address',
        'seller_fooder',
        'seller_prosperity_evaluation',
        'seller_possesion',

        'seller_position',
        'seller_pass_series_number',
        'seller_pass_issued_date',
        'seller_bank',
        'seller_bank_pay_account_number',

        'seller_fax',
        'seller_email',

        'travel_start_datetime',
        'travel_arrive_datetime',

        'seller_representative',
        'seller_post_code'
    ];

    public function doc_KV()
    {
        return $this->belongsTo('App\docKV', 'kv_id');
    }

    public function doc_PI()
    {
        return $this->belongsTo('App\docPI', 'pi_id');
    }

    public function doc_PP()
    {
        return $this->belongsTo('App\docPP', 'pp_id');
    }

    public function doc_SF()
    {
        return $this->belongsTo('App\docSF', 'sf_id');
    }

    public function doc_VG()
    {
        return $this->belongsTo('App\docVG', 'vg_id');
    }
}
