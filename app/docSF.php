<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docSF extends Model
{
    protected $table = "doc_SF";

    protected $fillable = [
        'farmer_pass_number',
        'serial',
        'no',
    ];

    public function pivot()
    {
        return $this->hasOne('App\DocsPivot', 'sf_id');
    }
}
