<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'user_id', 'name', 'total_animals', 'comment', 'phone', 'seller_address', 'pick_up_time'
    ];

    public function driver()
    {
    	return $this->belongsTo('App\Driver', 'user_id', 'id');
    }

    public function file() 
    {
        return $this->hasOne('App\File');
    }
}
