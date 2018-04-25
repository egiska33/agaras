<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docPP extends Model
{
    protected $table = "doc_PP";

    protected $fillable = [
        'bank',
        'bull_price',
        'heifer_price',
        'cow_price',
        'serial',
        'no',
    ];

    public function pivot()
    {
        return $this->hasOne('App\DocsPivot', 'pp_id');
    }
}
