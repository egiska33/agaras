<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'route_id', 'filename'
    ];
    
    const GLOBAL_FILE_NAME = 'pricelist.pdf';

    const GLOBAL_FILE_DEST = 'uploads';

    const GLOBAL_FILE_PATH = 'uploads/pricelist.pdf';

    public function route() 
    {
        return $this->belongsTo('App\Route');
    }
}
