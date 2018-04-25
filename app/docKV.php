<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docKV extends Model
{
    protected $table = "doc_KV";

    protected $fillable = [
        'user_travel_paper_number', 'serial', 'no',
    ];

    public function pivot()
    {
        return $this->hasOne('App\DocsPivot', 'kv_id');
    }
}
