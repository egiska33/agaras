<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docVG extends Model
{
    public $table = "doc_VG";

    protected $fillable = [
        'sex',
        'held_place_number',
        'herd_number',
        'held_adress',
        'travel_duration',
        'serial',
        'no',
        'vet_pass_number',
    ];

    public function pivot()
    {
        return $this->hasOne('App\DocsPivot', 'vg_id');
    }
}
