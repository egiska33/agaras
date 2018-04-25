<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docPI extends Model
{
    protected $table = "doc_PI";

    protected $fillable = [
        'check_number',
        'paid_for',
        'invoice_number',
        'paid_sum',
        'serial',
        'no',
    ];

    public function pivot()
    {
        return $this->hasOne('App\DocsPivot', 'pi_id');
    }
}
